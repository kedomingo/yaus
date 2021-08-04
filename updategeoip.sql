TRUNCATE geoip2_network;

load data infile 'geotmp/GeoIP2-City-Blocks-IPv6-Hex.csv'
into table geoip2_network
fields terminated by ',' enclosed by '"' lines terminated by '\n' ignore 1 rows
(@network_start, @network_end, @geoname_id, @registered_country_geoname_id, @represented_country_geoname_id,
 @is_anonymous_proxy, @is_satellite_provider, @postal_code, @latitude, @longitude, @accuracy_radius)
set network_start = unhex(@network_start),
    network_end = unhex(@network_end),
    geoname_id = nullif(@geoname_id, ''),
    registered_country_geoname_id = nullif(@registered_country_geoname_id, ''),
    represented_country_geoname_id = nullif(@represented_country_geoname_id, ''),
    is_anonymous_proxy = nullif(@is_anonymous_proxy, ''),
    is_satellite_provider = nullif(@is_satellite_provider, ''),
    postal_code = nullif(@postal_code, ''),
    latitude = nullif(@latitude, ''),
    longitude = nullif(@longitude, ''),
    accuracy_radius = nullif(@accuracy_radius, '');

load data infile 'geotmp/GeoIP2-City-Blocks-IPv4-Hex.csv'
into table geoip2_network
fields terminated by ',' enclosed by '"' lines terminated by '\n' ignore 1 rows
(@network_start, @network_end, @geoname_id, @registered_country_geoname_id, @represented_country_geoname_id,
 @is_anonymous_proxy, @is_satellite_provider, @postal_code, @latitude, @longitude, @accuracy_radius)
set network_start = unhex(@network_start),
    network_end = unhex(@network_end),
    geoname_id = nullif(@geoname_id, ''),
    registered_country_geoname_id = nullif(@registered_country_geoname_id, ''),
    represented_country_geoname_id = nullif(@represented_country_geoname_id, ''),
    is_anonymous_proxy = nullif(@is_anonymous_proxy, ''),
    is_satellite_provider = nullif(@is_satellite_provider, ''),
    postal_code = nullif(@postal_code, ''),
    latitude = nullif(@latitude, ''),
    longitude = nullif(@longitude, ''),
    accuracy_radius = nullif(@accuracy_radius, '');

TRUNCATE geoip2_location;

load data infile 'geotmp/GeoIP2-City-Locations-en.csv'
into table geoip2_location
fields terminated by ',' enclosed by '"' lines terminated by '\n' ignore 1 rows (
  geoname_id, locale_code, continent_code, continent_name,
  @country_iso_code, @country_name, @subdivision_1_iso_code, @subdivision_1_name,
  @subdivision_2_iso_code, @subdivision_2_name, @city_name, @metro_code, @time_zone,
  is_in_european_union
)
set country_iso_code = nullif(@country_iso_code, ''),
    country_name = nullif(@country_name, ''),
    subdivision_1_iso_code = nullif(@subdivision_1_iso_code, ''),
    subdivision_1_name = nullif(@subdivision_1_name, ''),
    subdivision_2_iso_code = nullif(@subdivision_2_iso_code, ''),
    subdivision_2_name = nullif(@subdivision_2_name, ''),
    city_name = nullif(@city_name, ''),
    metro_code = nullif(@metro_code, ''),
    time_zone = nullif(@time_zone, '');
