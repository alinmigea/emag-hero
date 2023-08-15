<?php

namespace AlinMigea\EmagHero\UseCases;

use AlinMigea\EmagHero\Models\PlayerInterface;

interface UseCaseInterface
{
    public function execute(PlayerInterface $attackingPlayer, PlayerInterface $defendingPlayer): int;
}
