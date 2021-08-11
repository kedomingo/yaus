<?php

declare(strict_types=1);

namespace Redir\app\repository;

use Redir\app\dto\AnalyticData;
use Redir\app\dto\Geolocation;
use Redir\app\dto\Visit;
use Redir\app\persistence\VisitDao;

class VisitRepository
{
    private VisitDao $dao;

    /**
     * RedirectRepository constructor.
     *
     * @param VisitDao $dao
     */
    public function __construct(VisitDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * @param string           $uri
     * @param string           $ipAddress
     * @param array            $queryParams
     * @param array            $browsercapabilities
     * @param Geolocation|null $geolocation
     * @param int|null         $redirectId
     */
    public function recordVisit(
        string $uri,
        string $ipAddress,
        array $queryParams,
        array $browsercapabilities,
        ?Geolocation $geolocation,
        ?int $redirectId
    ): void {
        $this->dao->writeVisit(
            $uri,
            $ipAddress,
            $browsercapabilities,
            $queryParams,
            $redirectId,
            ($geolocation !== null) ? $geolocation->getLatitude() : null,
            ($geolocation !== null) ? $geolocation->getLongitude() : null,
            ($geolocation !== null) ? $geolocation->getCityName() : null,
            ($geolocation !== null) ? $geolocation->getSubdivision1Name() : null,
            ($geolocation !== null) ? $geolocation->getCountryIsoCode() : null,
        );
    }

    /**
     * @return AnalyticData[]
     */
    public function getAnalyticsData(): array
    {
        $visits = $this->dao->getForAnalytics();
        return array_map(
            static function (Visit $visit): AnalyticData {
                return new AnalyticData(
                    $visit->getId(),
                    $visit->getCreated(),
                    $visit->getRedirectId(),
                    $visit->getUri(),
                    $visit->getIp(),
                    $visit->getLat(),
                    $visit->getLng(),
                    $visit->getCity(),
                    $visit->getRegion(),
                    $visit->getCountry(),
                    $visit->getPlatform(),
                    $visit->getBrowser(),
                    $visit->getBrowserType(),
                    $visit->getDeviceName(),
                    $visit->getDeviceMaker(),
                    $visit->getDeviceType(),
                    $visit->getDevicePointingMethod(),
                    $visit->getDeviceBrandName()
                );
            },
            $visits
        );
    }
}
