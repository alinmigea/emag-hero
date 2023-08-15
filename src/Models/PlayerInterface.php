<?php

namespace AlinMigea\EmagHero\Models;

use AlinMigea\EmagHero\Enums\PlayerTypeEnum;
use AlinMigea\EmagHero\Enums\SkillEnum;
use AlinMigea\EmagHero\Enums\StatEnum;

interface PlayerInterface
{
    public function setType(PlayerTypeEnum $type): self;
    public function getTypeName(): string;
    public function getStatByName(StatEnum $statEnum): ?Stat;
    public function addStatByName(StatEnum $statEnum, Stat $stat): void;
    public function removeStatByName(StatEnum $statEnum): void;
    public function getSkillByName(SkillEnum $skillEnum): ?Skill;
    public function addSkillByName(SkillEnum $skillEnum, Skill $skill): void;
    public function removeSkillByName(SkillEnum $skillEnum): void;
}
