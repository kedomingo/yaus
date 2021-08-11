<?php

declare(strict_types=1);

namespace Redir\app\dto;

use DateTimeImmutable;

class Visit
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
    private ?string $browser_bits;
    private ?string $browser_maker;
    private ?string $browser_modus;
    private ?string $version;
    private ?string $majorver;
    private ?string $minorver;
    private ?string $platform;
    private ?string $platform_version;
    private ?string $platform_description;
    private ?string $platform_bits;
    private ?string $platform_maker;
    private ?string $alpha;
    private ?string $beta;
    private ?string $win16;
    private ?string $win32;
    private ?string $win64;
    private ?string $frames;
    private ?string $iframes;
    private ?string $tables;
    private ?string $cookies;
    private ?string $backgroundsounds;
    private ?string $javascript;
    private ?string $vbscript;
    private ?string $javaapplets;
    private ?string $activexcontrols;
    private ?string $ismobiledevice;
    private ?string $istablet;
    private ?string $issyndicationreader;
    private ?string $crawler;
    private ?string $isfake;
    private ?string $isanonymized;
    private ?string $ismodified;
    private ?string $cssversion;
    private ?string $aolversion;
    private ?string $device_name;
    private ?string $device_maker;
    private ?string $device_type;
    private ?string $device_pointing_method;
    private ?string $device_code_name;
    private ?string $device_brand_name;
    private ?string $renderingengine_name;
    private ?string $renderingengine_version;
    private ?string $renderingengine_description;
    private ?string $renderingengine_maker;

    /**
     * @var string|DateTimeImmutable
     */
    private $created;

    private function __construct()
    {
        $this->lat = $this->lat !== null ? (float)$this->lat : null;
        $this->lng = $this->lng !== null ? (float)$this->lng : null;
        $this->created = new DateTimeImmutable($this->created);
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
    public function getBrowserBits(): ?string
    {
        return $this->browser_bits;
    }

    /**
     * @return string|null
     */
    public function getBrowserMaker(): ?string
    {
        return $this->browser_maker;
    }

    /**
     * @return string|null
     */
    public function getBrowserModus(): ?string
    {
        return $this->browser_modus;
    }

    /**
     * @return string|null
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @return string|null
     */
    public function getMajorver(): ?string
    {
        return $this->majorver;
    }

    /**
     * @return string|null
     */
    public function getMinorver(): ?string
    {
        return $this->minorver;
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
    public function getPlatformVersion(): ?string
    {
        return $this->platform_version;
    }

    /**
     * @return string|null
     */
    public function getPlatformDescription(): ?string
    {
        return $this->platform_description;
    }

    /**
     * @return string|null
     */
    public function getPlatformBits(): ?string
    {
        return $this->platform_bits;
    }

    /**
     * @return string|null
     */
    public function getPlatformMaker(): ?string
    {
        return $this->platform_maker;
    }

    /**
     * @return string|null
     */
    public function getAlpha(): ?string
    {
        return $this->alpha;
    }

    /**
     * @return string|null
     */
    public function getBeta(): ?string
    {
        return $this->beta;
    }

    /**
     * @return string|null
     */
    public function getWin16(): ?string
    {
        return $this->win16;
    }

    /**
     * @return string|null
     */
    public function getWin32(): ?string
    {
        return $this->win32;
    }

    /**
     * @return string|null
     */
    public function getWin64(): ?string
    {
        return $this->win64;
    }

    /**
     * @return string|null
     */
    public function getFrames(): ?string
    {
        return $this->frames;
    }

    /**
     * @return string|null
     */
    public function getIframes(): ?string
    {
        return $this->iframes;
    }

    /**
     * @return string|null
     */
    public function getTables(): ?string
    {
        return $this->tables;
    }

    /**
     * @return string|null
     */
    public function getCookies(): ?string
    {
        return $this->cookies;
    }

    /**
     * @return string|null
     */
    public function getBackgroundsounds(): ?string
    {
        return $this->backgroundsounds;
    }

    /**
     * @return string|null
     */
    public function getJavascript(): ?string
    {
        return $this->javascript;
    }

    /**
     * @return string|null
     */
    public function getVbscript(): ?string
    {
        return $this->vbscript;
    }

    /**
     * @return string|null
     */
    public function getJavaapplets(): ?string
    {
        return $this->javaapplets;
    }

    /**
     * @return string|null
     */
    public function getActivexcontrols(): ?string
    {
        return $this->activexcontrols;
    }

    /**
     * @return string|null
     */
    public function getIsmobiledevice(): ?string
    {
        return $this->ismobiledevice;
    }

    /**
     * @return string|null
     */
    public function getIstablet(): ?string
    {
        return $this->istablet;
    }

    /**
     * @return string|null
     */
    public function getIssyndicationreader(): ?string
    {
        return $this->issyndicationreader;
    }

    /**
     * @return string|null
     */
    public function getCrawler(): ?string
    {
        return $this->crawler;
    }

    /**
     * @return string|null
     */
    public function getIsfake(): ?string
    {
        return $this->isfake;
    }

    /**
     * @return string|null
     */
    public function getIsanonymized(): ?string
    {
        return $this->isanonymized;
    }

    /**
     * @return string|null
     */
    public function getIsmodified(): ?string
    {
        return $this->ismodified;
    }

    /**
     * @return string|null
     */
    public function getCssversion(): ?string
    {
        return $this->cssversion;
    }

    /**
     * @return string|null
     */
    public function getAolversion(): ?string
    {
        return $this->aolversion;
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
     * @return string|null
     */
    public function getDeviceCodeName(): ?string
    {
        return $this->device_code_name;
    }

    /**
     * @return string|null
     */
    public function getDeviceBrandName(): ?string
    {
        return $this->device_brand_name;
    }

    /**
     * @return string|null
     */
    public function getRenderingengineName(): ?string
    {
        return $this->renderingengine_name;
    }

    /**
     * @return string|null
     */
    public function getRenderingengineVersion(): ?string
    {
        return $this->renderingengine_version;
    }

    /**
     * @return string|null
     */
    public function getRenderingengineDescription(): ?string
    {
        return $this->renderingengine_description;
    }

    /**
     * @return string|null
     */
    public function getRenderingengineMaker(): ?string
    {
        return $this->renderingengine_maker;
    }

    /**
     * @return DateTimeImmutable|string
     */
    public function getCreated()
    {
        return $this->created;
    }
}
