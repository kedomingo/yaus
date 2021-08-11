<?php
// phpcs:ignoreFile -- this is not a core file

declare(strict_types=1);

require_once __DIR__ . "/../../vendor/autoload.php";

use Redir\console\App;
use Symfony\Component\Dotenv\Dotenv;

define('APP_DIR', __DIR__);

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../../.env');

$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../config/di.php');
$container = $containerBuilder->build();

$application = $container->get(App::class);
$application->run($container);

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
