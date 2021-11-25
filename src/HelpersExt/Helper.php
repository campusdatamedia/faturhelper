<?php

/**
 * @method bool|void has_access(string $permission_code, int $role, bool $isAbort = true)
 * @method string method(string $method)
 * @method string|int|null role(string|int $key)
 * @method string|array gender(string|null $code)
 * @method string|array status(string|null $code)
 * @method string|array religion(string|null $code)
 * @method string|array relationship(string|null $code)
 * @method string|array country_code(string|null $code)
 * @method string|array platform(string|null $code)
 * @method string slug(string $text)
 * @method string slugify(string $text, array $array)
 * @method string access_token()
 * @method array|null package(string|null $name)
 * @method string mime(string $type)
 * @method string quote(string|null $random)
 * @method string quill(string $html, string $path)
 * @method string hex_to_rgb(string $code)
 * @method object rgb_to_hsl(string $code)
 * @method string reverse_color(string $color)
 * @method string custom_view(string $view)
 */

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Ajifatur\Helpers\File as FileExt;

/**
 * Check the access for the permission.
 *
 * @param  string $permission_code
 * @param  int    $role
 * @param  bool   $isAbort
 * @return bool|void
 */
if(!function_exists('has_access')) {
    function has_access($permission_code, $role, $isAbort = true) {
        // Get the permission
        $permission = config('faturhelper.models.permission')::where('code','=',$permission_code)->first();

        // If the permission is not exist
        if(!$permission) {
            if($isAbort) abort(403);
            else return false;
        }

        // Check role permission
        if(in_array($role, $permission->roles()->pluck('role_id')->toArray())) {
            return true;
        }
        else {
            if($isAbort) abort(403);
            else return false;
        }
    }
}

/**
 * Get the method from object.
 *
 * @param  string $method
 * @return string
 */
if(!function_exists('method')) {
    function method($method) {
        $explode = explode('\\', $method);
        return end($explode);
    }
}

/**
 * Get the role ID or name.
 *
 * @param  string|int $key
 * @return string|int|null
 */
if(!function_exists('role')) {
    function role($key) {
        // Get the role by ID
        if(is_int($key)) {
            $role = config('faturhelper.models.role')::find($key);
            return $role ? $role->name : null;
        }
        // Get the role by key
        elseif(is_string($key)) {
            $role = config('faturhelper.models.role')::where('code','=',$key)->first();
            return $role ? $role->id : null;
        }
        else return null;
    }
}

/**
 * Get the gender.
 *
 * @param  string|null $code
 * @return string|array
 */
if(!function_exists('gender')) {
    function gender($code = null) {
        // Get genders from datasets
        $array = FileExt::json('gender.json');

        // Set the gender / genders
        if($code === null) return $array;
        else {
            $index = '';
            foreach($array as $key=>$value) {
                if($value['key'] == $code) $index = $key;
            }
            return array_key_exists($index, $array) ? $array[$index]['name'] : '';
        }
    }
}

/**
 * Get the status.
 *
 * @param  string|null $code
 * @return string|array
 */
if(!function_exists('status')) {
    function status($code = null) {
        // Get status from datasets
        $array = FileExt::json('status.json');

        // Set the status
        if($code === null) return $array;
        else {
            $index = '';
            foreach($array as $key=>$value) {
                if($value['key'] == $code) $index = $key;
            }
            return array_key_exists($index, $array) ? $array[$index]['name'] : '';
        }
    }
}

/**
 * Get the religion.
 *
 * @param  string|null $code
 * @return string|array
 */
if(!function_exists('religion')) {
    function religion($code = null) {
        // Get religions from datasets
        $array = FileExt::json('religion.json');

        // Set the religion / religion
        if($code === null) return $array;
        else {
            $index = '';
            foreach($array as $key=>$value) {
                if($value['key'] == $code) $index = $key;
            }
            return array_key_exists($index, $array) ? $array[$index]['name'] : '';
        }
    }
}

/**
 * Get the relationship.
 *
 * @param  string|null $code
 * @return string|array
 */
if(!function_exists('relationship')) {
    function relationship($code = null) {
        // Get relationships from datasets
        $array = FileExt::json('relationship.json');

        // Set the relationship / relationships
        if($code === null) return $array;
        else {
            $index = '';
            foreach($array as $key=>$value) {
                if($value['key'] == $code) $index = $key;
            }
            return array_key_exists($index, $array) ? $array[$index]['name'] : '';
        }
    }
}

/**
 * Get the country.
 *
 * @param  string|null $code
 * @return string|array
 */
if(!function_exists('country')) {
    function country($code = null) {
        // Get countries from datasets
        $array = FileExt::json('country-code.json');

        // Set the country / countries
        if($code === null) return $array;
        else {
            $index = '';
            foreach($array as $key=>$value) {
                if($value['code'] == $code) $index = $key;
            }
            return array_key_exists($index, $array) ? $array[$index]['name'] : '';
        }
    }
}

/**
 * Get the dial code.
 *
 * @param  string|null $code
 * @return string|array
 */
if(!function_exists('dial_code')) {
    function dial_code($code = null) {
        // Get dial codes from datasets
        $array = FileExt::json('country-code.json');

        // Set the dial code / dial codes
        if($code === null) return $array;
        else {
            $index = '';
            foreach($array as $key=>$value) {
                if($value['code'] == $code) $index = $key;
            }
            return array_key_exists($index, $array) ? $array[$index]['dial_code'] : '';
        }
    }
}

/**
 * Get the platform.
 *
 * @param  string|null $code
 * @return string|array
 */
if(!function_exists('platform')) {
    function platform($code = null) {
        // Get platforms from datasets
        $array = FileExt::json('platform.json');

        // Set the platform / platforms
        if($code === null) return $array;
        else {
            $index = '';
            foreach($array as $key=>$value) {
                if($value['key'] == $code) $index = $key;
            }
            return array_key_exists($index, $array) ? $array[$index]['name'] : '';
        }
    }
}

/**
 * Get the slug from the text.
 *
 * @param  string $text
 * @return string
 */
if(!function_exists('slug')) {
    function slug($text) {
        // Convert the text to lowercase
        $result = strtolower($text);

        // Filter text characters
        $result = preg_replace("/[^a-z0-9\s-]/", "", $result);

        // Trim the text
        $result = preg_replace("/\s+/", " ",$result);

        // Replace whitespace to dash
        $result = str_replace(" ", "-", $result);

        // Return
        return $result;
    }
}

/**
 * Slugify the text.
 *
 * @param  string $text
 * @param  array  $array
 * @return string
 */
if(!function_exists('slugify')) {
    function slugify($text, $array) {
        // Convert the text to slug
        $slug = slug($text);

        // Check the slug from exist slugs
        $i = 1;
        while(in_array($slug, $array)) {
            $i++;
            $slug = slug($text).'-'.$i;
        }

        // Return
        return $slug;
    }
}

/**
 * Generate the access token for user.
 *
 * @return string
 */
if(!function_exists('access_token')) {
    function access_token() {
        // Generate token
        $token = Str::random(40);

        // Get exist tokens
        $exist_tokens = config('faturhelper.models.user')::pluck('access_token')->toArray();

        // Check the token from exist tokens
        while(in_array($token, $exist_tokens)) {
            $token = Str::random(40);
        }

        // Return
        return $token;
    }
}

/**
 * Get the package.
 *
 * @param  string|null $name
 * @return array|null
 */
if(!function_exists('package')) {
    function package($name = null) {
        // Get the composer lock
        $composer = File::get(base_path('composer.lock'));

        // Get packages
        $array = json_decode($composer, true);
        $packages = array_key_exists('packages', $array) ? $array['packages'] : [];

        // Get the package if name is not null
        if($name === null) {
            return $packages;
        }
        else {
            $index = '';
            if(count($packages)>0){
                foreach($packages as $key=>$package) {
                    if($package['name'] == $name) $index = $key;
                }
            }
            return array_key_exists($index, $packages) ? $packages[$index] : null;
        }
    }
}

/**
 * Get the MIME by type.
 *
 * @param  string $type
 * @return string
 */
if(!function_exists('mime')) {
    function mime($type) {
        // Get MIME from datasets
        $array = FileExt::json('mime.json');

        // Get the extension by type
        $mime = '';
        foreach($array as $key=>$value) {
            if($value == $type) $mime = $key;
        }

        // Return
        return $mime;
    }
}

/**
 * Get the quote.
 *
 * @param  string|null $type
 * @return string
 */
if(!function_exists('quote')) {
    function quote($random = null) {
        // Get quotes from datasets
        $array = FileExt::json('quote.json');

        // If random
        if($random === 'random') {
            return $array[rand(0, count($array)-1)];
        }
        else {
            return $array;
        }
    }
}

/**
 * Set HTML entities from Quill Editor and upload the image.
 *
 * @param  string $html
 * @param  string $path
 * @return string
 */
if(!function_exists('quill')) {
    function quill($html, $path) {
        // Get the image from <img>
        $dom = new \DOMDocument;
        @$dom->loadHTML($html);
        $images = $dom->getElementsByTagName('img');

        foreach($images as $key=>$image) {
            // Get the "src" attribute
            $code = $image->getAttribute('src');

			// Get the image that not URL
            if(filter_var($code, FILTER_VALIDATE_URL) == false) {
                // Upload the image
                list($type, $code) = explode(';', $code);
                list(, $code)      = explode(',', $code);
                $code = base64_decode($code);
                $mime = str_replace('data:', '', $type);
                $image_name = date('Y-m-d-H-i-s').' ('.($key+1).')';
                $image_name = $image_name.'.'.mime($mime);
                file_put_contents($path.$image_name, $code);

                // Change the "src" attribute
                $image->setAttribute('src', URL::to('/').'/'.$path.$image_name);
            }
        }
        
        // Return
        return htmlentities($dom->saveHTML());
    }
}

/**
 * Convert Hex to RGB.
 *
 * @param  string $code
 * @return string
 */
if(!function_exists('hex_to_rgb')) {
    function hex_to_rgb($code) {
        if($code[0] == '#')
            $code = substr($code, 1);

        if(strlen($code) == 3)
            $code = $code[0] . $code[0] . $code[1] . $code[1] . $code[2] . $code[2];

        $r = hexdec($code[0] . $code[1]);
        $g = hexdec($code[2] . $code[3]);
        $b = hexdec($code[4] . $code[5]);

        return $b + ($g << 0x8) + ($r << 0x10);
    }
}

/**
 * Convert RGB to HSL.
 *
 * @param  string $code
 * @return object
 */
if(!function_exists('rgb_to_hsl')) {
    function rgb_to_hsl($code) {
        $r = 0xFF & ($code >> 0x10);
        $g = 0xFF & ($code >> 0x8);
        $b = 0xFF & $code;

        $r = ((float)$r) / 255.0;
        $g = ((float)$g) / 255.0;
        $b = ((float)$b) / 255.0;

        $maxC = max($r, $g, $b);
        $minC = min($r, $g, $b);

        $l = ($maxC + $minC) / 2.0;

        if($maxC == $minC) {
            $s = 0;
            $h = 0;
        }
        else {
            if($l < .5)
                $s = ($maxC - $minC) / ($maxC + $minC);
            else
                $s = ($maxC - $minC) / (2.0 - $maxC - $minC);

            if($r == $maxC)
                $h = ($g - $b) / ($maxC - $minC);
            if($g == $maxC)
                $h = 2.0 + ($b - $r) / ($maxC - $minC);
            if($b == $maxC)
                $h = 4.0 + ($r - $g) / ($maxC - $minC);

            $h = $h / 6.0; 
        }

        $h = (int)round(255.0 * $h);
        $s = (int)round(255.0 * $s);
        $l = (int)round(255.0 * $l);

        return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
    }
}

/**
 * Reverse the color to be dark or light.
 *
 * @param  string $color
 * @return string
 */
if(!function_exists('reverse_color')) {
    function reverse_color($color) {
        $hsl = rgb_to_hsl(hex_to_rgb($color));
        if($hsl->lightness > 200) return '#000000';
        else return '#ffffff';
    }
}

/**
 * Custom the view.
 *
 * @param  string $view
 * @return string
 */
if(!function_exists('custom_view')) {
    function custom_view($view) {
        if(config('faturhelper.package.view') == '')
            return $view;
        else
            return config('faturhelper.package.view')."::".$view;
    }
}