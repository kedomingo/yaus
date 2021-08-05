<?php

declare(strict_types=1);

namespace Redir\app\services;

use Psr\Http\Message\ServerRequestInterface;
use Redir\app\repository\VisitRepository;

class VisitService
{
    private BrowserCapabilityProvider $browserCapabilityProvider;
    private GeolocationProvider $geoLocationProvider;
    private IpAddressProvider $ipAddressProvider;
    private VisitRepository $visitRepository;
    private ServerRequestInterface $request;

    /**
     * VisitService constructor.
     *
     * @param BrowserCapabilityProvider $browserCapabilityProvider
     * @param GeolocationProvider       $geoLocationProvider
     * @param IpAddressProvider         $ipAddressProvider
     * @param VisitRepository           $visitRepository
     * @param ServerRequestInterface    $request
     */
    public function __construct(
        BrowserCapabilityProvider $browserCapabilityProvider,
        GeolocationProvider $geoLocationProvider,
        IpAddressProvider $ipAddressProvider,
        VisitRepository $visitRepository,
        ServerRequestInterface $request
    ) {
        $this->browserCapabilityProvider = $browserCapabilityProvider;
        $this->geoLocationProvider = $geoLocationProvider;
        $this->ipAddressProvider = $ipAddressProvider;
        $this->visitRepository = $visitRepository;
        $this->request = $request;
    }

    /**
     * @param string   $uri
     * @param int|null $redirectId
     */
    public function recordVisit(string $uri, ?int $redirectId): void
    {
        $ipAddress = $this->ipAddressProvider->getRealIP();
        $geolocation = $this->geoLocationProvider->getGeolocation($ipAddress);
        $browser = $this->browserCapabilityProvider->getBrowser();
        $params = $this->request->getQueryParams();

        $this->visitRepository->recordVisit(
            $uri,
            $ipAddress,
            $params,
            $browser,
            $geolocation,
            $redirectId
        );
    }
}
