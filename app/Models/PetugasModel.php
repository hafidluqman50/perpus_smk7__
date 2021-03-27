<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetugasModel extends Model
{
    protected $table      = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $guarded    = [];
    public $timestamps    = false;

    public static function showData()
    {
    	$query = self::join('users','petugas.id_users','=','users.id_users')
    				->get();
    	return $query;
    }
}
