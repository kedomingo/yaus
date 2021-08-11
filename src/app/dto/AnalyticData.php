<?php

declare(strict_types=1);

namespace Redir\app\dto;

use DateTimeImmutable;

class AnalyticData
{
    private int $id;
    private ?int $redirect_id;
    private ?string $uri;
    private ?string $ip;
    private ?float $lat;
    private ?float $lng;
    private ?string $city;
    private ?string $region;
    private ?string $country;
    private ?string $browser;
    private ?string $browser_type;

    private ?string $platform;
    private ?string $device_name;
    private ?string $device_maker;
    private ?string $device_type;
    private ?string $device_pointing_method;
    private ?string $device_brand_name;

    /**
     * @var string|DateTimeImmutable
     */
    private $created;

    /**
     * AnalyticData constructor.
     *
     * @param int                      $id
     * @param DateTimeImmutable|string $created
     * @param int|null                 $redirect_id
     * @param string|null              $uri
     * @param string|null              $ip
     * @param float|null               $lat
     * @param float|null               $lng
     * @param string|null              $city
     * @param string|null              $region
     * @param string|null              $country
     * @param string|null              $platform
     * @param string|null              $browser
     * @param string|null              $browser_type
     * @param string|null              $device_name
     * @param string|null              $device_maker
     * @param string|null              $device_type
     * @param string|null              $device_pointing_method
     * @param string|null              $device_brand_name
     */
    public function __construct(
        int $id,
        $created,
        ?int $redirect_id,
        ?string $uri,
        ?string $ip,
        ?float $lat,
        ?float $lng,
        ?string $city,
        ?string $region,
        ?string $country,
        ?string $platform,
        ?string $browser,
        ?string $browser_type,
        ?string $device_name,
        ?string $device_maker,
        ?string $device_type,
        ?string $device_pointing_method,
        ?string $device_brand_name
    ) {
        $this->id = $id;
        $this->redirect_id = $redirect_id;
        $this->uri = $uri;
        $this->ip = $ip;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
        $this->platform = $platform;
        $this->browser = $browser;
        $this->browser_type = $browser_type;
        $this->device_name = $device_name;
        $this->device_maker = $device_maker;
        $this->device_type = $device_type;
        $this->device_pointing_method = $device_pointing_method;
        $this->device_brand_name = $device_brand_name;
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getRedirectId(): ?int
    {
        return $this->redirect_id;
    }

    /**
     * @return string|null
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getBrowser(): ?string
    {
        return $this->browser;
    }

    /**
     * @return string|null
     */
    public function getBrowserType(): ?string
    {
        return $this->browser_type;
    }

    /**
     * @return string|null
     */
    public function getDeviceName(): ?string
    {
        return $this->device_name;
    }

    /**
     * @return string|null
     */
    public function getDeviceMaker(): ?string
    {
        return $this->device_maker;
    }

    /**
     * @return string|null
     */
    public function getDeviceType(): ?string
    {
        return $this->device_type;
    }

    /**
     * @return string|null
     */
    public function getDevicePointingMethod(): ?string
    {
        return $this->device_pointing_method;
    }

    /**
     * @return DateTimeImmutable|string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return string|null
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @return string|null
     */
    public function getDeviceBrandName(): ?string
    {
        return $this->device_brand_name;
    }
}












