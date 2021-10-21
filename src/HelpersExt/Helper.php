<?php

/**
 * @method bool|void has_access(string $permission_code, int $role, bool $isAbort = true)
 * @method string method(string $method)
 * @method string|int|null role(string|int $key)
 * @method string slug(string $text)
 * @method string slugify(string $text, array $array)
 * @method string mime(string $type)
 * @method string quill(string $html, string $path)
 */

use Illuminate\Support\Facades\File;

/**
 * Check the access for the permission.
 *
 * @param  string $permission_code
 * @param  int    $role
 * @param  bool   $isAbort
 * @return string
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
 * Get the MIME by type.
 *
 * @param  string $type
 * @return string
 */
if(!function_exists('mime')) {
    function mime($type) {
        // Get MIME from datasets
        $array = [];
        if(File::exists(base_path('vendor/ajifatur/faturhelper/json/mime.json'))) {
            $array = json_decode(File::get(base_path('vendor/ajifatur/faturhelper/json/mime.json')),true);
        }

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
 * Set HTML entities from Quill Editor and upload the image.
 *
 * @param  string $method
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