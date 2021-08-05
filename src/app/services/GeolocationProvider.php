<?php

declare(strict_types=1);

namespace Redir\app\services;

use Redir\app\dto\Geolocation;
use Redir\app\repository\GeolocationRepository;

class GeolocationProvider
{
    private GeolocationRepository $repository;

    /**
     * GeolocationProvider constructor.
     *
     * @param GeolocationRepository $repository
     */
    public function __construct(GeolocationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  string $ipAddress
     * @return Geolocation|null
     */
    public function getGeolocation(string $ipAddress): ?Geolocation
    {
        return $this->repository->getGeolocation($ipAddress);
    }
}
