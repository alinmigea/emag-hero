<?php

namespace AlinMigea\EmagHero\UseCases;

use AlinMigea\EmagHero\Enums\StatEnum;
use AlinMigea\EmagHero\Models\PlayerInterface;
use AlinMigea\EmagHero\Services\OutputServiceInterface;
use AlinMigea\EmagHero\Specifications\SpecificationInterface;

readonly class DamagedHealthUseCase implements UseCaseInterface
{
    public function __construct(
        private OutputServiceInterface $output,
        private SpecificationInterface $isLuckySpecification,
        private SpecificationInterface $hasLuckyDefenceSpecification,
        private SpecificationInterface $hasDoubleAttackSpecification,
    ) {
    }

    public function execute(PlayerInterface $attackingPlayer, PlayerInterface $defendingPlayer): int
    {
        $attackingPlayerStrength = $attackingPlayer->getStatByName(StatEnum::Strength) ? $attackingPlayer->getStatByName(StatEnum::Strength)->getValue() : null;
        $defendingPlayerHealth = $defendingPlayer->getStatByName(StatEnum::Health) ? $defendingPlayer->getStatByName(StatEnum::Health)->getValue() : null;

        if (!($attackingPlayerStrength && $defendingPlayerHealth)) {
            $this->output->error('Defending player or Attacking player stats undefined');
            return $defendingPlayerHealth;
        }

        $damage = abs($attackingPlayerStrength - $defendingPlayerHealth);
        if ($damage === 0) {
            $this->output->info('Defending player and Attacking player have equal stats, no damage');
            $this->output->info('Defending player damage is: ' . 0);
            return $defendingPlayerHealth;
        }

        // Hero / Beast - defending - is lucky
        if ($this->isLuckySpecification->isSatisfiedBy($defendingPlayer)) {
            $this->output->info('Defending player avoided the attack, Attacking player makes no damage');
            $this->output->info('Defending player damage is: ' . 0);
            return $defendingPlayerHealth;
        }

        // Hero - defending - skill SkillEnum::LuckyDefence
        if ($this->hasLuckyDefenceSpecification->isSatisfiedBy($defendingPlayer)) {
            $this->output->info('Defending player has lucky defence, Attacking player makes half the damage');
            $this->output->info('Defending player damage is: ' . intval($damage / 2));
            return $defendingPlayerHealth - intval($damage / 2);
        }

        // Hero - attacking - skill SkillEnum::DoubleAttack
        if ($this->hasDoubleAttackSpecification->isSatisfiedBy($attackingPlayer)) {
            $this->output->info('Defending player has no escape, Attacking player makes twice the damage');
            $this->output->info('Defending player damage is: ' . ($damage * 2));
            return $defendingPlayerHealth - ($damage * 2);
        }

        // Hero / Beast - defending - default damage
        $this->output->info('Defending player is hit, Attacking player makes default damage');
        $this->output->info('Defending player damage is: ' . $damage);
        return $defendingPlayerHealth - $damage;
    }
}
