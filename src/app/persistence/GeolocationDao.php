<?php

declare(strict_types=1);

namespace Redir\app\persistence;

use PDO;
use Redir\app\dto\Geolocation;

class GeolocationDao
{
    private string $locale;
    private PDO $pdo;

    /**
     * RedirectDao constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo, string $locale = 'en')
    {
        $this->pdo = $pdo;
        $this->locale = $locale;
    }

    public function getLocation(string $ipAddress): ?Geolocation
    {
        $sql = 'SELECT geo.*,
                       locale_code, 
                       continent_code, 
                       continent_name, 
                       country_iso_code, 
                       country_name, 
                       subdivision_1_iso_code, 
                       subdivision_1_name, 
                       subdivision_2_iso_code, 
                       subdivision_2_name, 
                       city_name, 
                       metro_code, 
                       time_zone
                  FROM (
                        SELECT geoname_id,
                               registered_country_geoname_id, 
                               represented_country_geoname_id,
                               postal_code,
                               latitude, 
                               longitude, 
                               accuracy_radius
                          FROM (
                               SELECT *
                               FROM geoip2_network
                               WHERE INET6_ATON(:ipAddress1) >= network_start
                               ORDER BY network_start DESC
                               LIMIT 1
                               ) net
                         WHERE inet6_aton(:ipAddress2) <= network_end
                        ) geo
              LEFT JOIN geoip2_location location 
                     ON geo.geoname_id = location.geoname_id 
                    AND location.locale_code = :locale
            
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue('ipAddress1', $ipAddress);
        $statement->bindValue('ipAddress2', $ipAddress);
        $statement->bindValue('locale', $this->locale);

        $statement->execute();

        $result = $statement->fetchObject(Geolocation::class);

        return !empty($result) ? $result : null;
    }
}
