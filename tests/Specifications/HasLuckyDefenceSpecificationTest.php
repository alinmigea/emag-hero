<?php

namespace AlinMigea\EmagHero\Test\Specifications;

use AlinMigea\EmagHero\Enums\PlayerTypeEnum;
use AlinMigea\EmagHero\Enums\SkillEnum;
use AlinMigea\EmagHero\Models\Player;
use AlinMigea\EmagHero\Models\Skill;
use AlinMigea\EmagHero\Specifications\HasLuckyDefenceSpecification;
use AlinMigea\EmagHero\Specifications\IsHeroSpecification;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

class HasLuckyDefenceSpecificationTest extends TestCase
{
    use ProphecyTrait;

    private ObjectProphecy|IsHeroSpecification $isHeroSpecification;
    private HasLuckyDefenceSpecification $hasLuckyDefenceSpecification;

    public function setUp(): void
    {
        parent::setUp();
        $this->isHeroSpecification = $this->prophesize(IsHeroSpecification::class);

        $this->hasLuckyDefenceSpecification = new HasLuckyDefenceSpecification(
            $this->isHeroSpecification->reveal(),
        );
    }

    public function testIsNotSatisfiedByBeastPlayer(): void
    {
        $player = (new Player())
            ->setType(PlayerTypeEnum::Beast);

        $this->isHeroSpecification->isSatisfiedBy($player)->shouldBeCalled()->willReturn(false);

        $this->assertFalse($this->hasLuckyDefenceSpecification->isSatisfiedBy($player));
    }

    public function testIsSatisfiedByHeroPlayerLuckyDefenceSkill(): void
    {
        $player = (new Player())
            ->setType(PlayerTypeEnum::Hero)
            ->setSkills(new ArrayCollection([
                SkillEnum::LuckyDefence->name => (new Skill())
                    ->setName(SkillEnum::LuckyDefence)
                    ->setMinLuck(0)
                    ->setMaxLuck(100), // for passing the random static call
            ]));

        $this->isHeroSpecification->isSatisfiedBy($player)->shouldBeCalled()->willReturn(true);

        $this->assertTrue($this->hasLuckyDefenceSpecification->isSatisfiedBy($player));
    }
}
