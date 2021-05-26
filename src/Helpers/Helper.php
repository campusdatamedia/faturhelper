<?php

/**
 * Main Helpers:
 * @method role(int|string $key)
 * @method setting(string $key)
 * @method setting_rules(string $key)
 * @method status(int $status)
 * @method gender(string $gender)
 * 
 * Array Helpers:
 * @method array_validation_messages()
 * @method array_indo_month()
 * 
 * Other Helpers:
 * @method slugify(string $text, string $table, string $field, string $primaryKey, int $id = null)
 * @method rename_permalink(string $permalink, int $count = 0)
 * @method upload_file(string $code, string $path)
 * @method upload_quill_image(string $code, string $path)
 * @method file_replace_contents(string $source_file, string $destination_file, string $contents1 = '', string $contents2 = '', bool $replace = false)
 * @method package(string $package)
 * @method composer_lock()
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Get role
if(!function_exists('role')){
    function role($key){
        // Check table role
        if(Schema::hasTable('role')){
            // If key is integer, get nama role
            if(is_int($key)){
                $role = DB::table('role')->where('id_role','=',$key)->first();
                return $role ? $role->nama_role : null;
            }
            // If key is string, get ID role
            elseif(is_string($key)){
                $role = DB::table('role')->where('key_role','=',$key)->first();
                return $role ? $role->id_role : null;
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }
}

// Get setting
if(!function_exists('setting')){
    function setting($key){
        // Check table settings
        if(Schema::hasTable('settings')){
            $setting = DB::table('settings')->where('setting_key','=',$key)->first();
            return $setting ? $setting->setting_value : '';
        }
        else{
            return null;
        }
    }
}

// Get setting rules
if(!function_exists('setting_rules')){
    function setting_rules($key){
        // Check table settings
        if(Schema::hasTable('settings')){
            $data = DB::table('settings')->where('setting_key',$key)->first();
            return $data ? $data->setting_rules : '';
        }
        else{
            return null;
        }
    }
}

// Get status
if(!function_exists('status')){
    function status($status){
        if($status == 1) return 'Aktif';
        elseif($status == 0) return 'Tidak Aktif';
        else return '';
    }
}

// Get gender
if(!function_exists('gender')){
    function gender($gender){
        if($gender == 'L') return 'Laki-Laki';
        elseif($gender == 'P') return 'Perempuan';
        else return '';
    }
}

/**
 *
 * Arrays
 * 
 */

// Array pesan validasi form
if(!function_exists('array_validation_messages')){
    function array_validation_messages(){
        $array = [
            'alpha' => 'Hanya bisa diisi dengan huruf!',
            'alpha_dash' => 'Hanya bisa diisi dengan huruf, angka, strip dan underscore!',
            'confirmed' => 'Tidak cocok!',
            'email' => 'Format penulisan email salah!',
            'max' => 'Harus diisi maksimal :max karakter!',
            'min' => 'Harus diisi minimal :min karakter!',
            'numeric' => 'Harus diisi dengan nomor atau angka!',
            'regex' => 'Format penulisan tidak valid!',
            'required' => 'Harus diisi!',
            'same' => 'Harus sama!',
            'unique' => 'Sudah terdaftar!',
        ];
        return $array;
    }
}

// Array nama bulan dalam Bahasa Indonesia
if(!function_exists('array_indo_month')){
    function array_indo_month(){
        $array = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        return $array;
    }
}

/**
 *
 * Others
 * 
 */

// Mengupload file
if(!function_exists('upload_file')){
    function upload_file($code, $path){
        // Decode base 64
        list($type, $code) = explode(';', $code);
        list(, $code)      = explode(',', $code);
        $code = base64_decode($code);
        $mime = str_replace('data:', '', $type);

        // Membuat nama file
        $file_name = date('Y-m-d-H-i-s');
        $file_name = $file_name.'.'.mime_to_ext($mime)[0];
        file_put_contents($path.$file_name, $code);

        // Return
        return $file_name;
    }
}

// Mengupload gambar dari Quill Editor
if(!function_exists('upload_quill_image')){
    function upload_quill_image($html, $path){
        // Mengambil gambar dari tag "img"
        $dom = new \DOMDocument;
        @$dom->loadHTML($html);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key=>$image){
            // Mengambil isi atribut "src"
            $code = $image->getAttribute('src');

			// Mencari gambar yang bukan URL
            if(filter_var($code, FILTER_VALIDATE_URL) == false){
                // Upload foto
                list($type, $code) = explode(';', $code);
                list(, $code)      = explode(',', $code);
                $code = base64_decode($code);
                $mime = str_replace('data:', '', $type);
                $image_name = date('Y-m-d-H-i-s').' ('.($key+1).')';
                $image_name = $image_name.'.'.mime_to_ext($mime)[0];
                file_put_contents($path.$image_name, $code);

                // Mengganti atribut "src"
                $image->setAttribute('src', URL::to('/').'/'.$path.$image_name);
            }
        }
        
        // Return
        return $dom->saveHTML();
    }
}

// Slugify
if(!function_exists('slugify')){
    function slugify($text, $table, $field, $primaryKey, $id = null){
        $permalink = generate_permalink($text);
        $i = 1;
        while(count_existing_data($table, $field, $permalink, $primaryKey, $id) > 0){
            $permalink = rename_permalink(generate_permalink($text), $i);
            $i++;
        }
        return $permalink;
    }
}

// Mengganti nama permalink jika ada yang sama
if(!function_exists('rename_permalink')){
    function rename_permalink($permalink, $count = 0){
        return $permalink."-".($count+1);
    }
}

// Mengganti konten file
if(!function_exists('file_replace_contents')){
    function file_replace_contents($source_file, $destination_file, $contents1 = '', $contents2 = '', $replace = false){
        // Jika konten kosong, berarti mengganti "semua" isi file
        if($contents1 == ''){
            if(File::exists($source_file) && File::exists($destination_file)){
                File::put($destination_file, File::get($source_file));
            }
        }
        // Jika konten tidak kosong, berarti mengganti isi file berdasarkan konten yang dicari
        else{
            // Jika belum pernah diupdate
            if(strpos(File::get($destination_file), $contents1) === false){
                // Jika false, tidak mereplace
                if($replace === false)
                    File::append($destination_file, $contents2);
                // Jika true, berarti mereplace
                else{
                    $get_contents = File::get($destination_file);
                    File::put($destination_file, str_replace($contents2, $contents1, $get_contents));
                }
            }
        }
    }
}

// Package
if(!function_exists('package')){
    function package($package){
        $array = composer_lock()['packages'];
        $index = '';
        if(count($array)>0){
            foreach($array as $key=>$data){
                if($data['name'] == $package) $index = $key;
            }
        }
        return array_key_exists($index, $array) ? $array[$index] : null;
    }
}

// Composer lock
if(!function_exists('composer_lock')){
    function composer_lock(){
        $content = File::get(base_path('composer.lock'));
        return json_decode($content, true);
    }
}