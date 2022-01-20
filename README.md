# FaturHelper

<p align="center">
  <a href="https://packagist.org/packages/campusdatamedia/faturhelper"><img src="https://poser.pugx.org/campusdatamedia/faturhelper/d/total.svg" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/campusdatamedia/faturhelper"><img src="https://poser.pugx.org/campusdatamedia/faturhelper/v/stable.svg" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/campusdatamedia/faturhelper"><img src="https://poser.pugx.org/campusdatamedia/faturhelper/license.svg" alt="License"></a>
</p>


## Introduction

FaturHelper is the project that contains some helpers/functions/methods to help my work easier.

## Prerequisite
- PHP >= 7.4
- DBMS MySQL >= 6.0
- Laravel >= 8.0

## Installation (v2)

### Download From Composer:

Run this script into your CLI:

```sh
composer require campusdatamedia/faturhelper
```

### Configuration:

Add this script into `app/Providers/AppServiceProvider.php` inside of `register` method:

``` php
if(File::exists(base_path('vendor/campusdatamedia/faturhelper/src'))) {
    foreach(glob(base_path('vendor/campusdatamedia/faturhelper/src').'/Helpers/*.php') as $filename) {
        require_once $filename;
    }
}
```

## Installation (v3)

### Download From Composer:

Run this script into your CLI:

```sh
composer require campusdatamedia/faturhelper
```

### Configuration:

Add this script into `config/app.php` in `providers` section:

``` php
Ajifatur\FaturHelper\FaturHelperServiceProvider::class,
```

### Enjoy!

## Docs
- [Helper](https://github.com/campusdatamedia/faturhelper/blob/master/readme/Helper.md)
- [Helper: DateTime](https://github.com/campusdatamedia/faturhelper/blob/master/readme/DateTime.md)
- [Helper: File](https://github.com/campusdatamedia/faturhelper/blob/master/readme/File.md)
