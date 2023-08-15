<?php

namespace AlinMigea\EmagHero\Specifications;

use AlinMigea\EmagHero\Models\PlayerInterface;

interface SpecificationInterface
{
    public function isSatisfiedBy(PlayerInterface $player): bool;
}
