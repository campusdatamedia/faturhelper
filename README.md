# FaturHelper

<p align="center">
  <a href="https://packagist.org/packages/ajifatur/faturhelper"><img src="https://poser.pugx.org/ajifatur/faturhelper/d/total.svg" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/ajifatur/faturhelper"><img src="https://poser.pugx.org/ajifatur/faturhelper/v/stable.svg" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/ajifatur/faturhelper"><img src="https://poser.pugx.org/ajifatur/faturhelper/license.svg" alt="License"></a>
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
composer require ajifatur/faturhelper
```

### Configuration:

Add this script into `app/Providers/AppServiceProvider.php` inside of `register` method:

``` php
if(File::exists(base_path('vendor/ajifatur/faturhelper/src'))) {
    foreach(glob(base_path('vendor/ajifatur/faturhelper/src').'/Helpers/*.php') as $filename) {
        require_once $filename;
    }
}
```

## Installation (v3)

### Download From Composer:

Run this script into your CLI:

```sh
composer require ajifatur/faturhelper
```

### Configuration:

Add Service Provider to `config/app.php` in `providers` section:

``` php
Ajifatur\FaturHelper\FaturHelperServiceProvider::class,
```

### Enjoy!

## Docs
- [Helper](https://github.com/ajifatur/faturhelper/blob/master/readme/Helper.md)
- [Helper: DateTime](https://github.com/ajifatur/faturhelper/blob/master/readme/DateTime.md)
- [Helper: File](https://github.com/ajifatur/faturhelper/blob/master/readme/File.md)

## Thanks to
- [Laravel](https://laravel.com)
- [AdminKit.io](https://adminkit.io)
- [ajifatur/assets](https://github.com/ajifatur/assets)
- [laravel/socialite](https://github.com/laravel/socialite)
- [rap2hpoutre/laravel-log-viewer](https://github.com/rap2hpoutre/laravel-log-viewer)

## Partners
- [Campus Data Media](https://campus.co.id)
- [Campus Digital](https://campusdigital.id)
- [PersonalityTalk](https://psikologanda.com)
- [Kompetensiku](https://kompetensiku.id)
- [Spandiv](https://spandiv.xyz)
