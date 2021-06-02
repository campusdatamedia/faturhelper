# FaturHelper

<p align="center">
  <a href="https://packagist.org/packages/ajifatur/faturhelper"><img src="https://poser.pugx.org/ajifatur/faturhelper/d/total.svg" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/ajifatur/faturhelper"><img src="https://poser.pugx.org/ajifatur/faturhelper/v/stable.svg" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/ajifatur/faturhelper"><img src="https://poser.pugx.org/ajifatur/faturhelper/license.svg" alt="License"></a>
</p>


## Introduction

FaturHelper is the project that contains some helpers/functions/methods to help my work easier.

## Prerequisite
- PHP >= 7.2
- DBMS MySQL >= 6.0
- Laravel >= 7.0

## Installation

### Download From Composer:

Run this script into your CLI:

```sh
composer require ajifatur/faturhelper
```

### Configuration:

Add this script into your Laravel AppServiceProvider inside of **register** method:

``` php
if(File::exists(base_path('vendor/ajifatur/faturhelper/src'))){
    foreach(glob(base_path('vendor/ajifatur/faturhelper/src').'/Helpers/*.php') as $filename){
        require_once $filename;
    }
}
```

### Enjoy!

## Partners
- [Campus Digital](https://campusdigital.id)
- [PersonalityTalk](https://psikologanda.com)
- [Kompetensiku](https://kompetensiku.id)
