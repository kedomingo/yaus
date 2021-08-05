<?php

declare(strict_types=1);

namespace Redir\app\dto;

class Geolocation
{
    private ?int $geoname_id;
    private ?int $registered_country_geoname_id;
    private ?int $represented_country_geoname_id;
    private ?int $postal_code;
    private ?float $latitude;
    private ?float $longitude;
    private ?float $accuracy_radius;
    private ?string $locale_code;
    private ?string $continent_code;
    private ?string $continent_name;
    private ?string $country_iso_code;
    private ?string $country_name;
    private ?string $subdivision_1_iso_code;
    private ?string $subdivision_1_name;
    private ?string $subdivision_2_iso_code;
    private ?string $subdivision_2_name;
    private ?string $city_name;
    private ?int $metro_code;
    private ?string $time_zone;

    /**
     * @return int|null
     */
    public function getGeonameId(): ?int
    {
        return $this->geoname_id;
    }

    /**
     * @return int|null
     */
    public function getRegisteredCountryGeonameId(): ?int
    {
        return $this->registered_country_geoname_id;
    }

    /**
     * @return int|null
     */
    public function getRepresentedCountryGeonameId(): ?int
    {
        return $this->represented_country_geoname_id;
    }

    /**
     * @return int|null
     */
    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @return float|null
     */
    public function getAccuracyRadius(): ?float
    {
        return $this->accuracy_radius;
    }

    /**
     * @return string|null
     */
    public function getLocaleCode(): ?string
    {
        return $this->locale_code;
    }

    /**
     * @return string|null
     */
    public function getContinentCode(): ?string
    {
        return $this->continent_code;
    }

    /**
     * @return string|null
     */
    public function getContinentName(): ?string
    {
        return $this->continent_name;
    }

    /**
     * @return string|null
     */
    public function getCountryIsoCode(): ?string
    {
        return $this->country_iso_code;
    }

    /**
     * @return string|null
     */
    public function getCountryName(): ?string
    {
        return $this->country_name;
    }

    /**
     * @return string|null
     */
    public function getSubdivision1IsoCode(): ?string
    {
        return $this->subdivision_1_iso_code;
    }

    /**
     * @return string|null
     */
    public function getSubdivision1Name(): ?string
    {
        return $this->subdivision_1_name;
    }

    /**
     * @return string|null
     */
    public function getSubdivision2IsoCode(): ?string
    {
        return $this->subdivision_2_iso_code;
    }

    /**
     * @return string|null
     */
    public function getSubdivision2Name(): ?string
    {
        return $this->subdivision_2_name;
    }

    /**
     * @return string|null
     */
    public function getCityName(): ?string
    {
        return $this->city_name;
    }

    /**
     * @return int|null
     */
    public function getMetroCode(): ?int
    {
        return $this->metro_code;
    }

    /**
     * @return string|null
     */
    public function getTimeZone(): ?string
    {
        return $this->time_zone;
    }
}
