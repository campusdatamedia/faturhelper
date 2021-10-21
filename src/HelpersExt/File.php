<?php

/**
 * @method static array get(string $path, array $exception)
 * @method static array info(string $filename)
 * @method static string setName(string $filename, array $array)
 * @method static int directorySize(string $path, array $exception)
 * @method static string byte(int $bytes)
 * @method static array json(string $path)
 */

namespace Ajifatur\Helpers;

use Illuminate\Support\Facades\File as LaravelFile;

class File
{
    /**
     * Get the file from directory.
     *
     * @param  string $path
     * @param  array  $exception
     * @return array
     */
    public static function get($path, $exception = [])
    {
        // Get all files
        $files = LaravelFile::allFiles($path);

        // Remove exception files
        if(count($exception) > 0) {
            foreach($files as $key=>$file) {
                if(in_array($file->getRelativePathname(), $exception)) unset($files[$key]);
            }
        }

        // Return
        return count($exception) > 0 ? array_values($files) : $files;
    }

    /**
     * Get the file info.
     *
     * @param  string $filename
     * @return array
     */
    public static function info($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $nameWithoutExtension = basename($filename, '.'.$extension);
        return [
            'name' => $filename,
            'nameWithoutExtension' => $nameWithoutExtension,
            'extension' => $extension
        ];
    }

    /**
     * Set the filename.
     *
     * @param  string $filename
     * @param  array  $array
     * @return string
     */
    public static function setName($filename, $array)
    {
        // Set the name from filename
        $name = $filename;

        // Check the name from exist filenames
        $i = 1;
        while(in_array($name, $array)) {
            $i++;
            $file_info = self::info($filename);
            $name = $file_info['nameWithoutExtension'].' ('.$i.').'.$file_info['extension'];
        }

        // Return
        return $name;
    }

    /**
     * Get the directory size.
     *
     * @param  string $path
     * @param  array  $exception
     * @return int
     */
    public static function directorySize($path, $exception = [])
    {
        // Get all files
        $files = LaravelFile::allFiles($path);

        // Remove exception files, also count directory size
        $dir_size = 0;
        foreach($files as $key=>$file) {
            if(in_array($file->getRelativePathname(), $exception))
                unset($files[$key]);
            else
                $dir_size += LaravelFile::size($path.'/'.$file->getRelativePathname());
        }

        // Return
        return $dir_size;
    }

    /**
     * Convert bytes to simple bytes.
     *
     * @param  int $bytes
     * @return string
     */
    public static function byte($bytes)
    {
        $kb = 1024;
        $mb = $kb * 1024;
        $gb = $mb * 1024;
        $tb = $gb * 1024;

        if(($bytes >= 0) && ($bytes < $kb))
            return $bytes . ' B';
        elseif(($bytes >= $kb) && ($bytes < $mb))
            return round($bytes / $kb) . ' KB';
        elseif(($bytes >= $mb) && ($bytes < $gb))
            return round($bytes / $mb) . ' MB';
        elseif(($bytes >= $gb) && ($bytes < $tb))
            return round($bytes / $gb) . ' GB';
        elseif($bytes >= $tb)
            return round($bytes / $tb) . ' TB';
        else
            return $bytes . ' B';
    }

    /**
     * Get datasets from JSON file.
     *
     * @param  string $path
     * @return array
     */
    public static function json($path)
    {
        $array = [];
        if(LaravelFile::exists(base_path('vendor/ajifatur/faturhelper/json/'.$path))) {
            $array = json_decode(LaravelFile::get(base_path('vendor/ajifatur/faturhelper/json/'.$path)), true);
        }
        return $array;
    }
}