# Helper

Methods:
- has_access
- method
- role
- gender
- status
- religion
- relationship
- country_code
- platform
- slug
- slugify
- access_token
- package
- mime
- quote
- quill
- hex_to_rgb
- rgb_to_hsl
- reverse_color
- custom_view

## has_access

Check the access for the permission by the role:

``` php
has_access(method(__METHOD__), Auth::user()->role_id); // Return: void or abort 403
```

The default of third parameter is true. If it's false, it will return boolean without aborting:

``` php
has_access('UserController::index', Auth::user()->role_id, false); // Return: boolean
```

## method

Get the method from the object:

``` php
echo method(__METHOD__); // Output: UserController::index
```

## role

Get the role name by ID:

``` php
echo role(1); // Output: Admin
```

Get the role ID by key:

``` php
echo role('admin'); // Output: 1
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

## status

Get the status by code:

``` php
echo status(1); // Output: Aktif
```

The default of parameter is null. If it's null, it will return the status array:

``` php
print_r(status()); // Output: [...]
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

## relationship

Get the relationship by code:

``` php
echo relationship(1); // Output: Lajang
```

The default of parameter is null. If it's null, it will return the relationship array:

``` php
print_r(relationship()); // Output: [...]
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

## platform

Get the platform by code:

``` php
echo platform(1); // Output: Facebook
```

The default of parameter is null. If it's null, it will return the platform array:

``` php
print_r(platform()); // Output: [...]
```

## slug

Get the slug from the text:

``` php
echo slug('Lorem Ipsum Sit Dolor Amet');
// Output: lorem-ipsum-sit-dolor-amet
```

## slugify

Set the slug according to exist array. If the slug is not in array, the slug won't be changed:

``` php
echo slugify('Lorem Ipsum Sit Dolor Amet', []);
// Output: lorem-ipsum-sit-dolor-amet
```

If the slug is in array, the slug will be changed:

``` php
echo slugify('Lorem Ipsum Sit Dolor Amet', ['lorem-ipsum-sit-dolor-amet']);
// Output: lorem-ipsum-sit-dolor-amet-2
```

## access_token

Generate the access token for user:

``` php
echo access_token(); // Output: abcd...z
```

## package

Get the package by name:

``` php
print_r(package('ajifatur/faturhelper')); // Output: [...]
```

The default of parameter is null. If it's null, it will return the package array:

``` php
print_r(package()); // Output: [...]
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

## quill

Set HTML entities from Quill Editor and upload the image:

``` php
echo quill('...'); // Output: ...
```

## hex_to_rgb

Convert Hex to RGB:

``` php
echo hex_to_rgb('#333333'); // Output: 3355443
```

## rgb_to_hsl

Convert RGB to HSL:

``` php
print_r(rgb_to_hsl('3355443')); // Output: {["hue"] => 0, ["saturation"] => 0, ["lightness"] => 51}
```

## reverse_color

Reverse the color to be dark or light:

``` php
echo reverse_color('#333333'); // Output: #ffffff
```

## custom_view

Custom the view according to the faturhelper.package.view:

``` php
faturhelper.package.view = '';
echo custom_view('admin/dashboard'); // Output: admin/dashboard

faturhelper.package.view = 'faturcms';
echo custom_view('admin/dashboard'); // Output: faturcms::admin/dashboard
```
