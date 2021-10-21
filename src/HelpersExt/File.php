<?php

namespace Ajifatur\Helpers;

/**
 * @method static array info(string $filename)
 * @method static string setName(string $filename, array $array)
 */
class File
{
    /**
     * Get the file info.
     *
     * @param  string $filename
     * @return string|null
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
}