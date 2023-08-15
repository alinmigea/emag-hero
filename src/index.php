<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use AlinMigea\EmagHero\Brokers\DamageConsumer;
use AlinMigea\EmagHero\Models\Damage;
use AlinMigea\EmagHero\Services\CliOutputService;
use AlinMigea\EmagHero\Services\GameService;
use AlinMigea\EmagHero\Specifications\HasDoubleAttackSpecification;
use AlinMigea\EmagHero\Specifications\HasLuckyDefenceSpecification;
use AlinMigea\EmagHero\Specifications\IsHeroSpecification;
use AlinMigea\EmagHero\Specifications\IsLuckySpecification;
use AlinMigea\EmagHero\UseCases\DamagedHealthUseCase;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

try {
    $cliOutput = new CliOutputService();
    $isHeroSpecification = new IsHeroSpecification();

    $handler = new DamageConsumer(
        new DamagedHealthUseCase(
            $cliOutput,
            new IsLuckySpecification(),
            new HasLuckyDefenceSpecification($isHeroSpecification),
            new HasDoubleAttackSpecification($isHeroSpecification)
        ),
    );

    $bus = new MessageBus([
        new HandleMessageMiddleware(
            new HandlersLocator([
                Damage::class => [$handler],
            ]),
        ),
    ]);

    $game = new GameService($cliOutput, $bus);
    $game->run();
} catch (Throwable $error) {
    echo '[ERROR] Please check the logs!' . PHP_EOL;
    $message = sprintf('[ERROR] [%d]: %s in %s on line %d', $error->getCode(), $error->getMessage(), $error->getFile(), $error->getLine());
    error_log($message . PHP_EOL, 3, __DIR__ . '/../logs/error.log');
}
