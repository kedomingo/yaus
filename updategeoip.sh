#!/bin/bash

## You need the following ENV variables. These can be defined in a `.env` file in dotenv format
##
## DB_CONNECTION=mysql
## DB_HOST=127.0.0.1
## DB_PORT=4306
## DB_DATABASE=ipsco_db
## DB_USERNAME=root
## DB_PASSWORD=test_pass
##
## MAXMIND_LICENSE=abcd1234

if [ `hostname` = 'server01.ips-cambodia.com' ]; then
  cd /home/ipsco/app
fi

if [ ! -f .env ]; then
  echo ".env file was not found. exit"
  exit
fi

export $(cat .env | sed 's/#.*//g' | xargs)

echo "Downloading GeoLite2"

wget "https://download.maxmind.com/app/geoip_download?edition_id=GeoLite2-City-CSV&license_key=${MAXMIND_LICENSE}&suffix=zip" -O maxmind.zip

if [ ! -f "maxmind.zip" ]; then
  echo "maxmind.zip was not downloaded. exit"
  exit
fi

echo "Unzipping maxmind.zip"

unzip maxmind.zip

# ROOT ONLY
# You can pre-create this dir and assign 777
# mkdir -p /var/lib/mysql/geotmp

dir=`ls | grep GeoLite2-City-CSV`

echo "Converting IP Blocks in ${dir}"

if [ -f "${dir}/GeoLite2-City-Blocks-IPv4.csv" ]; then
  `cp "${dir}/GeoLite2-City-Blocks-IPv4.csv" /var/lib/mysql/geotmp/GeoIP2-City-Blocks-IPv4.csv`
  `cp "${dir}/GeoLite2-City-Blocks-IPv6.csv" /var/lib/mysql/geotmp/GeoIP2-City-Blocks-IPv6.csv`
  `cp "${dir}/GeoLite2-City-Locations-en.csv" /var/lib/mysql/geotmp/GeoIP2-City-Locations-en.csv`
else
  `cp "${dir}/GeoIP2-City-Blocks-IPv4.csv" /var/lib/mysql/geotmp/GeoIP2-City-Blocks-IPv4.csv`
  `cp "${dir}/GeoIP2-City-Blocks-IPv6.csv" /var/lib/mysql/geotmp/GeoIP2-City-Blocks-IPv6.csv`
  `cp "${dir}/GeoIP2-City-Locations-en.csv" /var/lib/mysql/geotmp/GeoIP2-City-Locations-en.csv`
fi

suffix=""
if [ `uname` = 'Darwin' ]; then
  echo "Using mac version of geoip2-csv-converter"
  suffix="-mac"
fi

`./vendor/maxmind/geoip2-csv-converter${suffix}/geoip2-csv-converter -block-file /var/lib/mysql/geotmp/GeoIP2-City-Blocks-IPv4.csv -include-hex-range -output-file /var/lib/mysql/geotmp/GeoIP2-City-Blocks-IPv4-Hex.csv`
`./vendor/maxmind/geoip2-csv-converter${suffix}/geoip2-csv-converter -block-file /var/lib/mysql/geotmp/GeoIP2-City-Blocks-IPv6.csv -include-hex-range -output-file /var/lib/mysql/geotmp/GeoIP2-City-Blocks-IPv6-Hex.csv`


echo "Updating database tables"

`mysql -h $DB_HOST -P $DB_PORT -u $DB_USERNAME --password=$DB_PASSWORD $DB_DATABASE < updategeoip.sql`


echo "Removing temp files"

rm -rf /var/lib/mysql/geotmp/* GeoLite2-City-CSV_* maxmind.zip


echo "Done"
