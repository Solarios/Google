# Google API

A laravel wrapper for Google's API. It uses [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) as it's base.

## Installation

Require it with Composer by running

```
composer require solarios/google
```

Add the following to the service providers in `config/app.php`.
```php
Solarios\Google\GoogleServiceProvider::class,
```

There is also a facade available.
```php
'Google' => Solarios\Google\Facades\Google::class,
```

To publish the configuration file, run
```
php artisan vendor:publish
```

## Usage
Only the application authentication is currently supported (service provider/account).


### Examples
```php
$calendar = Google::calendar();
```
Returns the `Google_Service_Calendar` class.
```php
$calendarList = $calendar->calendarList->listCalendarList();
```
Gets a list of calendars.