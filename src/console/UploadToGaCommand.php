<?php

declare(strict_types=1);

namespace Redir\console;

use Redir\app\services\GoogleAnalyticsUploader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UploadToGaCommand extends Command
{
    protected static $defaultName = 'app:upload-ga';

    private GoogleAnalyticsUploader $analyticsUploader;

    /**
     * UploadToGaCommand constructor.
     * @param GoogleAnalyticsUploader $analyticsUploaer
     */
    public function __construct(GoogleAnalyticsUploader $analyticsUploaer)
    {
        parent::__construct();
        $this->analyticsUploader = $analyticsUploaer;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Uploads the visitor data to Google Analytics.')
            ->setHelp('This uploads the visitor data to Google Analyticss.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->analyticsUploader->upload();
        echo "Done";

        return 0;
    }
}
