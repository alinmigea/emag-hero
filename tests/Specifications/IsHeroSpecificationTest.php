<?php

namespace AlinMigea\EmagHero\Test\Specifications;

use AlinMigea\EmagHero\Enums\PlayerTypeEnum;
use AlinMigea\EmagHero\Models\Player;
use AlinMigea\EmagHero\Specifications\IsHeroSpecification;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class IsHeroSpecificationTest extends TestCase
{
    use ProphecyTrait;

    private IsHeroSpecification $isHeroSpecification;

    public function setUp(): void
    {
        parent::setUp();

        $this->isHeroSpecification = new IsHeroSpecification();
    }

    public function testIsNotSatisfiedByBeastPlayer(): void
    {
        $player = (new Player())
            ->setType(PlayerTypeEnum::Beast);

        $this->assertFalse($this->isHeroSpecification->isSatisfiedBy($player));
    }

    public function testIsSatisfiedByHeroPlayer(): void
    {
        $player = (new Player())
            ->setType(PlayerTypeEnum::Hero);

        $this->assertTrue($this->isHeroSpecification->isSatisfiedBy($player));
    }
}
