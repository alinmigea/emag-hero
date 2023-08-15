<?php

namespace AlinMigea\EmagHero\Services;

interface OutputServiceInterface
{
    public function info(string $message): void;
    public function error(string $message): void;
}
