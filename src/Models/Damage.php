<?php

namespace AlinMigea\EmagHero\Models;

class Damage
{
    private PlayerInterface $attackingPlayer;
    private PlayerInterface $defendingPlayer;

    public function getAttackingPlayer(): PlayerInterface
    {
        return $this->attackingPlayer;
    }

    public function setAttackingPlayer(PlayerInterface $attackingPlayer): self
    {
        $this->attackingPlayer = $attackingPlayer;

        return $this;
    }

    public function getDefendingPlayer(): PlayerInterface
    {
        return $this->defendingPlayer;
    }

    public function setDefendingPlayer(PlayerInterface $defendingPlayer): self
    {
        $this->defendingPlayer = $defendingPlayer;

        return $this;
    }
}
