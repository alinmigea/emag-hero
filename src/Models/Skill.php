<?php

namespace AlinMigea\EmagHero\Models;

use AlinMigea\EmagHero\Enums\SkillEnum;

class Skill
{
    private SkillEnum $name;
    private int $minLuck = 0;
    private int $maxLuck = 100;

    public function getName(): SkillEnum
    {
        return $this->name;
    }

    public function setName(SkillEnum $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMinLuck(): int
    {
        return $this->minLuck;
    }

    public function setMinLuck(int $minLuck): self
    {
        $this->minLuck = $minLuck;

        return $this;
    }

    public function getMaxLuck(): int
    {
        return $this->maxLuck;
    }

    public function setMaxLuck(int $maxLuck): self
    {
        $this->maxLuck = $maxLuck;

        return $this;
    }
}
