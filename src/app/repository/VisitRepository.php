<?php

declare(strict_types=1);

namespace Redir\app\repository;

use Redir\app\dto\Geolocation;
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
}
