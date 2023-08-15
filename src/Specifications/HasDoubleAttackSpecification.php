<?php

namespace AlinMigea\EmagHero\Specifications;

use AlinMigea\EmagHero\Enums\SkillEnum;
use AlinMigea\EmagHero\Helpers\RandomLuckHelper;
use AlinMigea\EmagHero\Models\PlayerInterface;

readonly class HasDoubleAttackSpecification implements SpecificationInterface
{
    public function __construct(
        private IsHeroSpecification $isHeroSpecification,
    ) {
    }

    public function isSatisfiedBy(PlayerInterface $player): bool
    {
        $doubleAttackSkill = $player->getSkillByName(SkillEnum::DoubleAttack);

        return $this->isHeroSpecification->isSatisfiedBy($player) &&
            $doubleAttackSkill &&
            RandomLuckHelper::isLucky($doubleAttackSkill->getMinLuck(), $doubleAttackSkill->getMaxLuck());
    }
}
