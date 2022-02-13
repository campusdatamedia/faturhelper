# Dataset

Methods:
- datasets
- gender
- platform
- relationship
- religion
- status
- bootstrap_icons
- country
- dial_code
- mime
- quota

## datasets

Get the array of available datasets. The parameter is only `small` and `large`:

``` php
print_r(datasets('small')); // Output: [...]
print_r(datasets('large')); // Output: [...]
```

If the parameter is not from those two, it will return empty array:

``` php
print_r(datasets('big')); // Output: []
```

## gender

Get the gender by code:

``` php
echo gender('L'); // Output: Laki-Laki
```

The default of parameter is null. If it's null, it will return the gender array:

``` php
print_r(gender()); // Output: [...]
```

## platform

Get the platform by code:

``` php
echo platform(1); // Output: Facebook
```

The default of parameter is null. If it's null, it will return the platform array:

``` php
print_r(platform()); // Output: [...]
```

## relationship

Get the relationship by code:

``` php
echo relationship(1); // Output: Lajang
```

The default of parameter is null. If it's null, it will return the relationship array:

``` php
print_r(relationship()); // Output: [...]
```

## religion

Get the religion by code:

``` php
echo religion(1); // Output: Islam
```

The default of parameter is null. If it's null, it will return the religion array:

``` php
print_r(religion()); // Output: [...]
```

## status

Get the status by code:

``` php
echo status(1); // Output: Aktif
```

The default of parameter is null. If it's null, it will return the status array:

``` php
print_r(status()); // Output: [...]
```

## bootstrap_icons

Get the bootstrap icons array:

``` php
print_r(bootstrap_icons()); // Output: [...]
```

## country

Get the country by code:

``` php
echo country('ID'); // Output: Indonesia
```

The default of parameter is null. If it's null, it will return the country array:

``` php
print_r(country()); // Output: [...]
```

## dial_code

Get the dial code by code:

``` php
echo dial_code('ID'); // Output: +62
```

The default of parameter is null. If it's null, it will return the dial code array:

``` php
print_r(dial_code()); // Output: [...]
```

## mime

Get the mime by type:

``` php
echo mime('image/png'); // Output: png
```

## quote

Get the random quote:

``` php
echo quote('random'); // Output: Living like Larry
```

The default of parameter is null. If it's null, it will return the quote array:

``` php
print_r(quote()); // Output: [...]
```
