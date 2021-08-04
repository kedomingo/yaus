<?php declare(strict_types=1);

use DI\Container;
use Doctrine\Common\Cache\FilesystemCache;
use GuzzleHttp\Psr7\ServerRequest;
use Monolog\Logger;
use Psr\Http\Message\ServerRequestInterface;
use Redir\app\services\BrowserCapabilityProvider;
use Roave\DoctrineSimpleCache\SimpleCacheAdapter;


return [
    PDO::class => getDbConnection(),
    BrowserCapabilityProvider::class => static function (Container $c) {
        $fileCache = new FilesystemCache(APP_DIR . '/browsercap-cache');
        $cache = new SimpleCacheAdapter($fileCache);
        $logger = new Logger('name');

        return new BrowserCapabilityProvider($cache, $logger);
    },
    ServerRequestInterface::class => static function (Container $c) {
        return ServerRequest::fromGlobals();
    }
];
