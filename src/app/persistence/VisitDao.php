<?php

declare(strict_types=1);

namespace Redir\app\persistence;

use PDO;
use Redir\app\dto\Visit;

class VisitDao
{
    private PDO $pdo;

    private const BROWSER_FIELDS = [
        'browser',
        'browser_type',
        'browser_bits',
        'browser_maker',
        'browser_modus',
        'version',
        'majorver',
        'minorver',
        'platform',
        'platform_version',
        'platform_description',
        'platform_bits',
        'platform_maker',
        'alpha',
        'beta',
        'win16',
        'win32',
        'win64',
        'frames',
        'iframes',
        'tables',
        'cookies',
        'backgroundsounds',
        'javascript',
        'vbscript',
        'javaapplets',
        'activexcontrols',
        'ismobiledevice',
        'istablet',
        'issyndicationreader',
        'crawler',
        'isfake',
        'isanonymized',
        'ismodified',
        'cssversion',
        'aolversion',
        'device_name',
        'device_maker',
        'device_type',
        'device_pointing_method',
        'device_code_name',
        'device_brand_name',
        'renderingengine_name',
        'renderingengine_version',
        'renderingengine_description',
        'renderingengine_maker'
    ];


    /**
     * RedirectDao constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string      $uri
     * @param string      $ipAddress
     * @param array       $browserCapabilities
     * @param array       $queryParams
     * @param int|null    $redirectId
     * @param float|null  $lat
     * @param float|null  $lng
     * @param string|null $city
     * @param string|null $region
     * @param string|null $country
     */
    public function writeVisit(
        string $uri,
        string $ipAddress,
        array $browserCapabilities,
        array $queryParams,
        ?int $redirectId,
        ?float $lat,
        ?float $lng,
        ?string $city,
        ?string $region,
        ?string $country
    ): void {
        $binds = [
            'redirect_id' => $redirectId,
            'uri' => $uri,
            'ip' => $ipAddress,
            'lat' => $lat,
            'lng' => $lng,
            'city' => $city,
            'region' => $region,
            'country' => $country,
        ];

        $inserts = array_keys($binds);
        foreach (self::BROWSER_FIELDS as $browserField) {
            if (isset($browserCapabilities[$browserField]) && trim('' . $browserCapabilities[$browserField]) !== '') {
                $inserts[] = $browserField;
                $binds[$browserField] = $browserCapabilities[$browserField];
            }
        }

        $sql = sprintf(
            'INSERT INTO visits(%s) VALUES (:%s)',
            implode(', ', $inserts),
            implode(', :', array_keys($binds))
        );

        $statement = $this->pdo->prepare($sql);
        foreach ($binds as $k => $v) {
            $statement->bindValue($k, $v);
        }
        $statement->execute();

        $this->writeParams((int)$this->pdo->lastInsertId(), $queryParams);
    }

    private function writeParams(int $visitId, array $params): void
    {
        $sql = 'INSERT INTO visit_params(visit_id, param_key, param_value) 
                VALUES (:visit_id, :param_key, :param_value)';

        $statement = $this->pdo->prepare($sql);
        foreach ($params as $k => $v) {
            $statement->bindValue('visit_id', $visitId);
            $statement->bindValue('param_key', $k);
            $statement->bindValue('param_value', $v);
            $statement->execute();
        }
    }

    /**
     * @return Visit[]
     */
    public function getForAnalytics(): array
    {
        $fields = [
            'id',
            'created',
            'redirect_id',
            'uri',
            'ip',
            'lat',
            'lng',
            'city',
            'region',
            'country',
        ];
        $fields = array_merge($fields, self::BROWSER_FIELDS);
        $sql = sprintf('SELECT %s FROM visits', implode(',', $fields));

        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Visit::class);
    }
}
