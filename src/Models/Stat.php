<?php

namespace AlinMigea\EmagHero\Models;

use AlinMigea\EmagHero\Enums\StatEnum;

class Stat
{
    private StatEnum $name;
    private int $min = 0;
    private int $max = 100;
    private int $value = 0;

    public function getName(): StatEnum
    {
        return $this->name;
    }

    public function setName(StatEnum $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }
}
