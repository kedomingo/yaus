<?php

declare(strict_types=1);

namespace Redir\app\services;

use BrowscapPHP\Browscap;
use Monolog\Logger;
use Roave\DoctrineSimpleCache\SimpleCacheAdapter;

class BrowserCapabilityProvider
{
    private SimpleCacheAdapter $cache;
    private Logger $logger;

    /**
     * BrowserCapabilityProvider constructor.
     *
     * @param SimpleCacheAdapter $cache
     * @param Logger             $logger
     */
    public function __construct(SimpleCacheAdapter $cache, Logger $logger)
    {
        $this->cache = $cache;
        $this->logger = $logger;
    }

    public function getBrowser(): array
    {
        $bc = new Browscap($this->cache, $this->logger);

        return json_decode(json_encode($bc->getBrowser(), JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
    }
}
