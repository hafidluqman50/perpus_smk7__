<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuRusakModel extends Model
{
    protected $table      = 'buku_rusak';
    protected $primaryKey = 'id_buku_rusak';
    protected $guarded    = [];
    public $timestamps    = false;

    public static function getData()
    {
    	$get = self::join('buku','buku_rusak.id_buku','=','buku.id_buku')
    				->get();

    	return $get;
    }
}
