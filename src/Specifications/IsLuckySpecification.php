<?php

namespace AlinMigea\EmagHero\Specifications;

use AlinMigea\EmagHero\Enums\StatEnum;
use AlinMigea\EmagHero\Helpers\RandomLuckHelper;
use AlinMigea\EmagHero\Models\PlayerInterface;

class IsLuckySpecification implements SpecificationInterface
{
    public function isSatisfiedBy(PlayerInterface $player): bool
    {
        $luckStat = $player->getStatByName(StatEnum::Luck);

        return $luckStat && RandomLuckHelper::isLucky($luckStat->getMin(), $luckStat->getMax());
    }
}
