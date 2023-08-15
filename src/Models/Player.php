<?php

namespace AlinMigea\EmagHero\Models;

use AlinMigea\EmagHero\Enums\PlayerTypeEnum;
use AlinMigea\EmagHero\Enums\SkillEnum;
use AlinMigea\EmagHero\Enums\StatEnum;
use Doctrine\Common\Collections\ArrayCollection;

class Player implements PlayerInterface
{
    private PlayerTypeEnum $type;
    private ArrayCollection $stats;
    private ArrayCollection $skills;

    public function __construct()
    {
        $this->stats = new ArrayCollection();
        $this->skills = new ArrayCollection();
    }

    public function getType(): PlayerTypeEnum
    {
        return $this->type;
    }

    public function setType(PlayerTypeEnum $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStats(): ArrayCollection
    {
        return $this->stats;
    }

    public function setStats(ArrayCollection $stats): self
    {
        $this->stats = $stats;

        return $this;
    }

    public function getSkills(): ArrayCollection
    {
        return $this->skills;
    }

    public function setSkills(ArrayCollection $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getTypeName(): string
    {
        return $this->type->name;
    }

    public function getStatByName(StatEnum $statEnum): ?Stat
    {
        return $this->stats->get($statEnum->name);
    }

    public function addStatByName(StatEnum $statEnum, Stat $stat): void
    {
        $exists = $this->getStatByName($statEnum);
        if ($exists) {
            return;
        }

        $this->stats->set($statEnum->name, $stat);
    }

    public function removeStatByName(StatEnum $statEnum): void
    {
        $this->stats->remove($statEnum->name);
    }

    public function getSkillByName(SkillEnum $skillEnum): ?Skill
    {
        return $this->skills->get($skillEnum->name);
    }

    public function addSkillByName(SkillEnum $skillEnum, Skill $skill): void
    {
        $exists = $this->getSkillByName($skillEnum);
        if ($exists) {
            return;
        }

        $this->skills->set($skillEnum->name, $skill);
    }

    public function removeSkillByName(SkillEnum $skillEnum): void
    {
        $this->skills->remove($skillEnum->name);
    }

    public function __toString(): string
    {
        $string = 'Player type: ' . $this->type->name . PHP_EOL;

        $string .= 'Player stats: ' . PHP_EOL;
        foreach ($this->stats as $stat) {
            /** @var Stat $stat */
            $string .= $stat->getName()->name . ': ' . $stat->getValue() . PHP_EOL;
        }

        $string .= 'Player skills: ' . PHP_EOL;
        foreach ($this->skills as $skill) {
            /** @var Skill $skill */
            $string .= $skill->getName()->name . ': ' . $skill->getMinLuck() . ' - ' . $skill->getMaxLuck() . PHP_EOL;
        }

        return $string;
    }
}
