<?php

declare(strict_types=1);

namespace Redir\app\services;

use Google\Exception;
use Google\Service\Analytics;
use Redir\app\dto\AnalyticData;
use Redir\app\repository\VisitRepository;
use RuntimeException;

class GoogleAnalyticsUploader
{
    private Analytics $analytics;
    private VisitRepository $visitRepository;

    /**
     * GoogleAnalyticsUploader constructor.
     * @param Analytics       $analytics
     * @param VisitRepository $visitRepository
     */
    public function __construct(Analytics $analytics, VisitRepository $visitRepository)
    {
        $this->analytics = $analytics;
        $this->visitRepository = $visitRepository;
    }

    public function upload()
    {
        $data = $this->visitRepository->getAnalyticsData();

        echo "Uploading\n";
        $filePath = $this->buildCsv($data);
        $this->uploadToGA($filePath);

        unlink($filePath);
        echo "Done\n";
    }

    /**
     * @param AnalyticData[] $inputs
     * @return string File path
     */
    private function buildCsv(array $inputs): string
    {
        $envVars = [
            'GA_INDEX_ID',
            'GA_INDEX_IP',
            'GA_INDEX_BROWSER',
            'GA_INDEX_BROWSER_TYPE',
            'GA_INDEX_CITY',
            'GA_INDEX_COUNTRY',
            'GA_INDEX_DEVICE_MAKER',
            'GA_INDEX_REGION',
            'GA_INDEX_PLATFORM',
            'GA_INDEX_DEVICE_NAME',
            'GA_INDEX_DEVICE_TYPE',
            'GA_INDEX_DEVICE_POINTING_METHOD',
            'GA_INDEX_DEVICE_BRAND_NAME',
        ];
        $headers = array_map(
            static function (string $envVar): string {
                return 'ga:dimension' . $_ENV[$envVar];
            },
            $envVars
        );

        $filepath = tempnam(sys_get_temp_dir(), 'goog_csv_');
        $f = fopen($filepath, 'wb');
        if (!$f) {
            throw new RuntimeException("Failed to create a temp file to write CSV");
        }
        fputcsv($f, $headers);

        array_map(
            static function (AnalyticData $row) use ($f): void {
                fputcsv(
                    $f,
                    [
                        $row->getId(),
                        $row->getIp(),
                        $row->getBrowser(),
                        $row->getBrowserType(),
                        $row->getCity(),
                        $row->getCountry(),
                        $row->getDeviceMaker(),
                        $row->getRegion(),
                        $row->getPlatform(),
                        $row->getDeviceName(),
                        $row->getDeviceType(),
                        $row->getDevicePointingMethod(),
                        $row->getDeviceBrandName()
                    ]
                );
            },
            $inputs
        );
        fclose($f);

        return $filepath;
    }

    /**
     * @param string $filePath
     */
    private function uploadToGA(string $filePath)
    {
        try {
            $this->analytics->management_uploads->uploadData(
                '177822840',
                'UA-177822840-1',
                '0aZ2Fah8Q_OwMdiPJ6hfeQ',
                array(
                    'data' => file_get_contents($filePath),
                    'mimeType' => 'application/octet-stream',
                    'uploadType' => 'media'
                )
            );
        } catch (Exception $e) {
            echo 'There was an Analytics API service error ' . $e->getCode() . ':' . $e->getMessage();
            echo $e->getTraceAsString();
        }
    }
}
