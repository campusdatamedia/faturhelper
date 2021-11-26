# File

Methods:
- get
- info
- setName
- directorySize
- byte
- json

How to use the object:

```php
use Ajifatur\Helpers\File as FileExt;
```

## get

Get the file from directory:

``` php
print_r(FileExt::get(public_path('assets/css')));
// Output: ['style.css', 'style.min.css']
```

The default of second parameter is []. If it's not [], it will get the file except the second parameter:

``` php
print_r(FileExt::get(public_path('assets/css'), ['style.min.css']));
// Output: ['style.css']
```

## info

Get the file information:

``` php
print_r(FileExt::info(public_path('assets/css/style.css')));
// Output: ['name' => 'style.css', 'nameWithoutExtension' => 'style', 'extension' => 'css']
```

## setName

Set the file name according to exist array. If the file name is not in array, the file name won't be changed:

``` php
echo FileExt::setName('style.css', ['style.min.css', 'dark-theme.min.css', 'light-theme.min.css']);
// Output: style.css
```

If the file name is in array, the file name will be changed:

``` php
echo FileExt::setName('style.css', ['style.css', 'style.min.css', 'dark-theme.min.css', 'light-theme.min.css']);
// Output: style (2).css
```

## directorySize

Get the directory size:

``` php
echo FileExt::directorySize(public_path('assets/css'));
// Output: 12 KB
```

The default of second parameter is []. If it's not [], it will get the directory size except the second parameter:

``` php
print_r(FileExt::get(public_path('assets/css'), ['style.min.css']));
// Output: 10 KB
```

## byte

Convert bytes to simple bytes:

``` php
echo FileExt::byte(5120); // Output: 5 KB
```

## json

Get datasets from the available JSON file:

``` php
print_r(FileExt::json('status.json'));
// Output: [['key' => 1, 'name' => 'Aktif'], ['key' => 2, 'name' => 'Banned'], ['key' => 0, 'name' => 'Tidak Aktif']]
```
