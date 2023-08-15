<?php

namespace AlinMigea\EmagHero\Services;

use AlinMigea\EmagHero\Enums\StatEnum;
use AlinMigea\EmagHero\Models\Damage;
use AlinMigea\EmagHero\Models\Player;
use AlinMigea\EmagHero\Models\PlayerInterface;
use AlinMigea\EmagHero\Models\Skill;
use AlinMigea\EmagHero\Models\Stat;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Yaml\Yaml;

class GameService
{
    private PlayerInterface $attackingPlayer;
    private PlayerInterface $defendingPlayer;

    private int $currentRound = 1;
    private int $maxRounds = 20;

    public function __construct(
        private readonly OutputServiceInterface $output,
        private readonly MessageBusInterface    $messageBus,
    ) {
    }

    public function run(): void
    {
        $this->output->info('Game is on');

        $players = $this->initialize();
        $this->position($players);

        while (!$this->over()) {
            $this->play();
            $this->currentRound++;
            $this->switch();
        }

        $this->output->info('Game is over');
    }

    private function initialize(): ArrayCollection
    {
        $parsedPlayers = Yaml::parseFile(__DIR__ . '/../../configs/players.yaml', Yaml::PARSE_CONSTANT);

        $players = new ArrayCollection();
        foreach ($parsedPlayers['players'] as $parsedPlayer) {
            $player = (new Player())->setType($parsedPlayer['type']);

            if (isset($parsedPlayer['stats'])) {
                foreach ($parsedPlayer['stats'] as $parsedStat) {
                    $stat = (new Stat())
                        ->setName($parsedStat['name'])
                        ->setMin($parsedStat['min'])
                        ->setMax($parsedStat['max'])
                        ->setValue(rand($parsedStat['min'], $parsedStat['max']));

                    $player->addStatByName($stat->getName(), $stat);
                }
            }

            if (isset($parsedPlayer['skills'])) {
                foreach ($parsedPlayer['skills'] as $parsedSkill) {
                    $skill = (new Skill())
                        ->setName($parsedSkill['name'])
                        ->setMinLuck($parsedSkill['minLuck'])
                        ->setMaxLuck($parsedSkill['maxLuck']);

                    $player->addSkillByName($skill->getName(), $skill);
                }
            }

            $players->add($player);
        }

        return $players;
    }

    private function position(ArrayCollection $players): void
    {
        [$this->attackingPlayer, $this->defendingPlayer] = $players;

        if ($this->attackingPlayer->getStatByName(StatEnum::Speed)->getValue() > $this->defendingPlayer->getStatByName(StatEnum::Speed)->getValue()) {
            return;
        }

        if (
            $this->attackingPlayer->getStatByName(StatEnum::Speed)->getValue() < $this->defendingPlayer->getStatByName(StatEnum::Speed)->getValue() ||
            $this->attackingPlayer->getStatByName(StatEnum::Luck)->getValue() == $this->defendingPlayer->getStatByName(StatEnum::Luck)->getValue()
        ) {
            $this->switch();
        }
    }

    private function over(): bool
    {
        if ($this->currentRound > $this->maxRounds) {
            $this->output->info('Game is over, max rounds reached');
            $this->output->info('No winner');
            return true;
        }

        if ($this->attackingPlayer->getStatByName(StatEnum::Health)->getValue() <= 0) {
            $this->output->info('Game is over, ' . $this->attackingPlayer->getTypeName() . ' died after ' . $this->currentRound - 1 . ' rounds.');
            $this->output->info('Winner is: ' . $this->defendingPlayer->getTypeName());
            return true;
        }

        return false;

    }

    private function switch(): void
    {
        $temp = $this->attackingPlayer;
        $this->attackingPlayer = $this->defendingPlayer;
        $this->defendingPlayer = $temp;
    }

    private function play(): void
    {
        $this->output->info('Current round is: ' . $this->currentRound);

        $this->output->info('Attacking player is: ' . $this->attackingPlayer->getTypeName() . ' (' .
            StatEnum::Strength->name . ':' . $this->attackingPlayer->getStatByName(StatEnum::Strength)->getValue() . ' ' .
            StatEnum::Health->name . ':' . $this->attackingPlayer->getStatByName(StatEnum::Health)->getValue() . ')'
        );
        $this->output->info('Defending player is: ' . $this->defendingPlayer->getTypeName() . ' (' .
            StatEnum::Strength->name . ':' . $this->defendingPlayer->getStatByName(StatEnum::Strength)->getValue() . ' ' .
            StatEnum::Health->name . ':' . $this->defendingPlayer->getStatByName(StatEnum::Health)->getValue() . ')'
        );

        //$this->output->info(strval($this->attackingPlayer));
        //$this->output->info(strval($this->defendingPlayer));

        $this->attack();
    }

    private function attack(): void
    {
        $damage = (new Damage())
            ->setAttackingPlayer($this->attackingPlayer)
            ->setDefendingPlayer($this->defendingPlayer);

        $this->messageBus->dispatch($damage);
    }
}
