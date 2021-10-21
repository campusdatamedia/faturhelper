<?php

/**
 * @method string method(string $method)
 * @method string mime(string $type)
 * @method string quill(string $html, string $path)
 */

use Illuminate\Support\Facades\File;

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