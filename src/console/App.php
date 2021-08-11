<?php

namespace Redir\console;

use DI\Container;
use Symfony\Component\Console\Application;

require_once __DIR__ . "/bootstrap.php";

class App
{
    public function run(Container $container)
    {
        $application = $container->get(Application::class);
        $application->add($container->get(UploadToGaCommand::class));
        $application->run();
    }
}
