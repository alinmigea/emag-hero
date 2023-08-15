<?php

namespace AlinMigea\EmagHero\Brokers;

use AlinMigea\EmagHero\Enums\StatEnum;
use AlinMigea\EmagHero\Models\Damage;
use AlinMigea\EmagHero\UseCases\UseCaseInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class DamageConsumer
{
    public function __construct(
        private UseCaseInterface $useCase,
    ) {
    }

    public function __invoke(Damage $message): void
    {
        $attackingPlayer = $message->getAttackingPlayer();
        $defendingPlayer = $message->getDefendingPlayer();

        $damagedDefendingPlayerHealth = $this->useCase->execute($attackingPlayer, $defendingPlayer);
        $defendingPlayer->getStatByName(StatEnum::Health)->setValue($damagedDefendingPlayerHealth);
    }
}
