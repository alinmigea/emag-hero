<?php

namespace AlinMigea\EmagHero\Test\Specifications;

use AlinMigea\EmagHero\Enums\PlayerTypeEnum;
use AlinMigea\EmagHero\Enums\StatEnum;
use AlinMigea\EmagHero\Models\Player;
use AlinMigea\EmagHero\Models\Stat;
use AlinMigea\EmagHero\Specifications\IsLuckySpecification;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class IsLuckySpecificationTest extends TestCase
{
    use ProphecyTrait;

    private IsLuckySpecification $isLuckySpecification;

    public function setUp(): void
    {
        parent::setUp();

        $this->isLuckySpecification = new IsLuckySpecification();
    }

    public function testIsNotSatisfiedByBeastPlayer(): void
    {
        $player = (new Player())
            ->setType(PlayerTypeEnum::Beast);

        $this->assertFalse($this->isLuckySpecification->isSatisfiedBy($player));
    }

    public function testIsSatisfiedByHeroPlayerWithLuckStat(): void
    {
        $player = (new Player())
            ->setType(PlayerTypeEnum::Hero)
            ->setStats(new ArrayCollection([
                StatEnum::Luck->name => (new Stat())
                    ->setName(StatEnum::Luck)
                    ->setMin(0)
                    ->setMax(100), // for passing the random static call
            ]));

        $this->assertTrue($this->isLuckySpecification->isSatisfiedBy($player));
    }
}
