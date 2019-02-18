# GermaniaKG · UsersRetailers

[![Packagist](https://img.shields.io/packagist/v/germania-kg/users-retailers.svg?style=flat)](https://packagist.org/packages/germania-kg/users-retailers)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/users-retailers.svg)](https://packagist.org/packages/germania-kg/users-retailers)
[![Build Status](https://img.shields.io/travis/GermaniaKG/UsersRetailers.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/UsersRetailers)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/UsersRetailers/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/UsersRetailers/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/UsersRetailers/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/UsersRetailers/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/UsersRetailers/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/UsersRetailers/build-status/master)


## Installation with Composer

```bash
$ composer require germania-kg/users-retailers
```

**MySQL users** may install the table *users\_retailers* using `users_retailers.sql.txt` in `sql/` directory.

## Find a retailer number

```php
<?php
use Germania\UsersRetailers\RetailerNumberFinder;

// These are pptional
$table  = 'users_retailers';
$logger = new Monolog;

$finder = new RetailerNumberFinder( $pdo);
$finder = new RetailerNumberFinder( $pdo, $logger, $table);

$user_id = 1;
$retailer_number = $finder( $user_id );
```



## Development

```bash
$ git clone https://github.com/GermaniaKG/UsersRetailers.git
$ cd UsersRetailers
$ composer install
```

Develop using `develop` branch, using [Git Flow](https://github.com/nvie/gitflow).   

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```

### MySQL Setup

Setup a MySQL table `users\_retailers` as in `sql/users_retailers.sql.txt `. 
In `phpunit.xml`, edit the database credentials:

```xml
<php>
	<var name="DB_DSN"    value="mysql:host=127.0.0.1;dbname=DBNAME;charset=utf8" />
	<var name="DB_USER"   value="DBUSER" />
	<var name="DB_PASSWD" value="DBPASS" />
	<var name="DB_DBNAME" value="DBNAME" />
	<var name="DB_SETUP"  value="sql/users_retailers.sql.txt" />
</php>
```

