# Yet Another URL Shortener 

## Description

Y.A.U.S. is a Short URL Redirector and Tracker.

This project is meant to be used as a free marketing tool to implement short urls and to track users using them. Currently,
there is only raw tracking data. This can be fed into an analytics tool for further analysis of link performance.

It uses Maxmind's [GeoLite2](https://dev.maxmind.com/geoip/geolite2-free-geolocation-data?lang=en) for IP address based 
geolocation. It also uses [Browsercap-PHP](https://github.com/browscap/browscap-php) to detect client browser capability
based on the user agent.

## Installation

1. Download this repository into a directory outside your webserver's document root
2. Copy `index.php` and `.htaccess` to your document root. Modify `index.php` to point to the correct location of `bootstrap.php`
3. If testing locally, you may use PHP's built in webserver by running `php -S localhost:8080 router.php`. `router.php` acts as the rewrite module in the absence of the real one.
4. Run tables.sql to create the required database tables.

## Setup 
1. Copy `.env.sample` into `.env`
2. Supply your database connection details in `.env`
3. [Sign up for Maxmind Geolite2](https://www.maxmind.com/en/geolite2/signup?lang=en) or GeoIP2 if you have the budget
4. [Create a Maxmind License Key](https://www.maxmind.com/en/accounts/current/license-key?lang=en)
5. Put the license key in your `.env` file
6. Supply the default domain name where users will be redirected to in case no redirection is setup for the visited route. This is the `APP_URL` in `.env` 
7. Run `composer install`

## Setup Admin UI
1. Copy the whole `admin/` folder into your server's document root. Modify `admin/index.php` to point to the correct location of 
    `maintenance.php`, `autoload.php`, and `app.php`
2. From the terminal, go inside the `admin_app` directory
2. Within `admin_app` copy `.env.sample` into `.env`
3. Within `admin_app`, supply your database connection details in `.env`
4. Within `admin_app`, run `composer install`
5. Within `admin_app`, run `php artisan migrate`
6. Within `admin_app`, run `php artisan make:user <email> [--name="Your Name"] [--password="initial password"]` to create your first user.
   if the password is not provided, the initial password will be displayed. Take note of it.
7. [Optional] setup the email settings in `.env` so that the forgot password function will work. 

### Updating the Browsercap database

Run `sh updatebrowsercap.sh` to update the browsercap file database and cache. You may schedule a cronjob to schedule this, say, every 2 weeks.

### Updating the Maxmind GeoLite2/GeoIP2 database

The GeoLite updater downloads the CSV files from Maxmind's servers, processes them, and imports them into mysql using `LOAD DATA INFILE`.
There are a few things you need to make sure before running this update script:

  1. Determine the import directory that mysql will use. Usually this is `/var/lib/mysql/`. 
     Run `mkdir /var/lib/mysql/geotmp`, `chmod 777 /var/lib/mysql/geotmp` to create the temporary import directory for mysql. 
     You may need to run this as root/sudo. You only need to do this once. 
  2. Make sure your database user has a `File` privilege granted

Run `sh updategeoip.sh` to update the GeoLite2/GepIP2 ip and location database.
You may schedule a cronjob to schedule this, say, every 2 weeks.

## Redirection and Tracking

If a redirection is setup for the visited path (e.g., `/test`), the visitor will be redirected to the destination URL.
Otherwise, the user will be redirected to the `APP_URL` setup in `.env`.

Any visit to your domain where this is hosted will trigger a page view. An entry to the `visits` table will be added
for each visit. The `$_GET` parameters will be added to the `visit_params` table if there are any. Available geolocation and browser information
will be available in the `visits` table. 


## Admin

An admin interface is included to manage the short URLs. If you followed the setup instructions, it can be accessed
from `http://<yoursite>/admin`. 

### Login

Login using the user that was added using `php artisan make:user`

<p align="center"><img src="https://raw.githubusercontent.com/kedomingo/yaus/main/etc/images/login.png" width="640"></p>

### The Dashboard

A simple collection of metrics will be displayed in the dashboard

<p align="center"><img src="https://raw.githubusercontent.com/kedomingo/yaus/main/etc/images/dashboard.png" width="640"></p>

### Managing Short URLs

The list of short URLs will be displayed in the Redirects page.


<p align="center"><img src="https://raw.githubusercontent.com/kedomingo/yaus/main/etc/images/redirects.png" width="640"></p>

To create a new short URL, hit the `New` button, fill up the details and save

<p align="center"><img src="https://raw.githubusercontent.com/kedomingo/yaus/main/etc/images/create.png" width="640"></p>

To deactivate a short URL, edit the short URL and uncheck 'Active' and save.


## Development

This code is written to be ran on *nix environments (Linux, Mac).

Maxmind's [CSV converter](https://github.com/maxmind/geoip2-csv-converter) is only available in binary unless you want to compile the source code written in Golang.
A mac version will be installed by composer if you set `--dev` flag of composer.

If you have Docker and `docker-compose` installed, a `docker-compose.yaml` file is included so you can spin up a disposable db in your local. 
The default username and password is: user:root password:test_pass. The server will be available at localhost:4306.

```
docker-compose up -d db
```

