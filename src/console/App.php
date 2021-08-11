<?php

namespace Redir\console;

use DI\Container;
use Symfony\Component\Console\Application;

class App
{
    public function run(Container $container)
    {
        $application = $container->get(Application::class);
        $application->add($container->get(UploadToGaCommand::class));
        $application->run();
    }
}
