<?php

namespace AlinMigea\EmagHero\Services;

class CliOutputService implements OutputServiceInterface
{
    public function info(string $message): void
    {
        self::message($message, 'INFO');
    }

    public function error(string $message): void
    {
        self::message($message, 'ERROR');
    }

    private static function message(string $message, string $prefix): void
    {
        $formattedMessage = '[' . $prefix . '] ' . $message . PHP_EOL;
        echo $formattedMessage;
    }
}
