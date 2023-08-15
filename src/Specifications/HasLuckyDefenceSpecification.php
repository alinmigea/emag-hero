<?php

namespace AlinMigea\EmagHero\Specifications;

use AlinMigea\EmagHero\Enums\SkillEnum;
use AlinMigea\EmagHero\Helpers\RandomLuckHelper;
use AlinMigea\EmagHero\Models\PlayerInterface;

readonly class HasLuckyDefenceSpecification implements SpecificationInterface
{
    public function __construct(
        private IsHeroSpecification $isHeroSpecification,
    ) {
    }

    public function isSatisfiedBy(PlayerInterface $player): bool
    {
        $luckyDefenceSkill = $player->getSkillByName(SkillEnum::LuckyDefence);

        return $this->isHeroSpecification->isSatisfiedBy($player) &&
            $luckyDefenceSkill &&
            RandomLuckHelper::isLucky($luckyDefenceSkill->getMinLuck(), $luckyDefenceSkill->getMaxLuck());
    }
}
