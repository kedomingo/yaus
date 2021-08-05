<?php

declare(strict_types=1);

namespace Redir\app\repository;

use Redir\app\dto\Geolocation;
use Redir\app\persistence\GeolocationDao;

class GeolocationRepository
{
    private GeolocationDao $dao;

    /**
     * GeolocationRepository constructor.
     *
     * @param GeolocationDao $dao
     */
    public function __construct(GeolocationDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * @param  string $ipAddress
     * @return Geolocation|null\
     */
    public function getGeolocation(string $ipAddress): ?Geolocation
    {
        return $this->dao->getLocation($ipAddress);
    }
}
