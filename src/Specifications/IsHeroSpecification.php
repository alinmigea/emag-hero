<?php

namespace AlinMigea\EmagHero\Specifications;

use AlinMigea\EmagHero\Enums\PlayerTypeEnum;
use AlinMigea\EmagHero\Models\PlayerInterface;

class IsHeroSpecification implements SpecificationInterface
{
    public function isSatisfiedBy(PlayerInterface $player): bool
    {
        return $player->getTypeName() == PlayerTypeEnum::Hero->name;
    }
}
