<?php

/**
 * Count Helpers:
 * @method int count_existing_data(string $table, string $field, string $keyword, string $primaryKey, int $id = null)
 */

// Menghitung jumlah data duplikat
if(!function_exists('count_existing_data')){
    function count_existing_data($table, $field, $keyword, $primaryKey, $id = null){
        if($id == null) $data = DB::table($table)->where($field,'=',$keyword)->count();
        else $data = DB::table($table)->where($field,'=',$keyword)->where($primaryKey,'!=',$id)->count();
        return $data;
    }
}