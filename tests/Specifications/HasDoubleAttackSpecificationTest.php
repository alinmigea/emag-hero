<?php

namespace AlinMigea\EmagHero\Test\Specifications;

use AlinMigea\EmagHero\Enums\PlayerTypeEnum;
use AlinMigea\EmagHero\Enums\SkillEnum;
use AlinMigea\EmagHero\Models\Player;
use AlinMigea\EmagHero\Models\Skill;
use AlinMigea\EmagHero\Specifications\HasDoubleAttackSpecification;
use AlinMigea\EmagHero\Specifications\IsHeroSpecification;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

class HasDoubleAttackSpecificationTest extends TestCase
{
    use ProphecyTrait;

    private ObjectProphecy|IsHeroSpecification $isHeroSpecification;
    private HasDoubleAttackSpecification $hasDoubleAttackSpecification;

    public function setUp(): void
    {
        parent::setUp();
        $this->isHeroSpecification = $this->prophesize(IsHeroSpecification::class);

        $this->hasDoubleAttackSpecification = new HasDoubleAttackSpecification(
            $this->isHeroSpecification->reveal(),
        );
    }

    public function testIsNotSatisfiedByBeastPlayer(): void
    {
        $player = (new Player())
            ->setType(PlayerTypeEnum::Beast);

        $this->isHeroSpecification->isSatisfiedBy($player)->shouldBeCalled()->willReturn(false);

        $this->assertFalse($this->hasDoubleAttackSpecification->isSatisfiedBy($player));
    }

    public function testIsSatisfiedByHeroPlayerWithDoubleAttackSkill(): void
    {
        $player = (new Player())
            ->setType(PlayerTypeEnum::Hero)
            ->setSkills(new ArrayCollection([
                SkillEnum::DoubleAttack->name => (new Skill())
                    ->setName(SkillEnum::DoubleAttack)
                    ->setMinLuck(0)
                    ->setMaxLuck(100), // for passing the random static
            ]));

        $this->isHeroSpecification->isSatisfiedBy($player)->shouldBeCalled()->willReturn(true);

        $this->assertTrue($this->hasDoubleAttackSpecification->isSatisfiedBy($player));
    }
}
