<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaModel extends Model
{
    protected $table      = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $guarded    = [];
    public $timestamps    = false;

    // public function tipe_anggota() {
    // 	return $this->belongsTo('App\Models\TipeAnggotaModel','id_tipe_anggota');
    // }

    public static function showAnggota($tipe) {
    	$query = self::join('users','anggota.id_users','=','users.id_users')
    				->where('tipe_anggota',$tipe)
                    ->where('anggota.status_delete',0)
    				->get();
    	return $query;
    }

    public static function getId($id) {
        $query = self::join('tipe_anggota','anggota.id_tipe_anggota','=','tipe_anggota.id_tipe_anggota')
                    ->where('id_anggota',$id)
                    ->firstOrFail();
        return $query;
    }

    public static function getData($id) {
        $db = self::join('users','anggota.id_users','=','users.id_users')->where('id_anggota',$id)->firstOrFail();
        return $db;
    }
}
