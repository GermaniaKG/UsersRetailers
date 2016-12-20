#Germania\UsersRetailers

[![Build Status](https://travis-ci.org/GermaniaKG/UsersRetailers.svg?branch=master)](https://travis-ci.org/GermaniaKG/UsersRetailers)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/UsersRetailers/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/UsersRetailers/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/UsersRetailers/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/UsersRetailers/?branch=master)



##Installation

```bash
$ composer require germania-kg/users-retailers
```

**MySQL users** may install the table *users\_retailers* using `users_retailers.sql.txt` in `sql/` directory.

##Find a retailer number

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



##Development and Testing

First, grab your clone:

```bash
$ git clone git@github.com:GermaniaKG/UsersRetailers.git users-retailers
$ cd users-retailers
$ composer install
$ cp phpunit.xml.dist phpunit.xml
```

Develop using `develop` branch, using [Git Flow](https://github.com/nvie/gitflow).   

Setup a MySQL table `users\_retailers` as in `sql/users_retailers.sql.txt `. 

In `phpunit.xml`, edit the database credentials:

```xml
<php>
	<var name="DB_DSN"    value="mysql:host=localhost;dbname=DBNAME;charset=utf8" />
	<var name="DB_USER"   value="DBUSER" />
	<var name="DB_PASSWD" value="DBPASS" />
	<var name="DB_DBNAME" value="DBNAME" />
	<var name="DB_SETUP"  value="sql/users_retailers.sql.txt" />
</php>
```


Go to project root and issue `phpunit`.

