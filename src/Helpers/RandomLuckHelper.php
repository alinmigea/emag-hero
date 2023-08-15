<?php

namespace AlinMigea\EmagHero\Helpers;

class RandomLuckHelper
{
    private const MIN = 0;
    private const MAX = 100;

    public static function isLucky(int $min, int $max): bool
    {
        $random = \rand(self::MIN, self::MAX);

        if ($min > $random || $max < $random) {
            return false;
        }

        return true;
    }
}
