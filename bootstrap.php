<?php

declare(strict_types=1);

require_once "vendor/autoload.php";

use Redir\app\App;
use Symfony\Component\Dotenv\Dotenv;

define('APP_DIR', __DIR__);

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');

$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/src/config/di.php');
$container = $containerBuilder->build();

$app = $container->get(App::class);
$app->execute();

function getDbConnection(): PDO
{
    $dsn = sprintf(
        "%s:host=%s;dbname=%s;%s",
        $_ENV['DB_CONNECTION'],
        $_ENV['DB_HOST'],
        $_ENV['DB_DATABASE'],
        !empty($_ENV['DB_PORT']) ? 'port=' . $_ENV['DB_PORT'] : '',
    );

    $pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}
