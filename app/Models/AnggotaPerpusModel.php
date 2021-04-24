<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaPerpusModel extends Model
{
	protected $table      = 'anggota_perpus';
	protected $primaryKey = 'id_anggota_perpus';
	protected $guarded    = [];
	public $timestamps    = false;

    public static function getRow($id)
    {
    	$get = self::join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
    				->join('users','anggota.id_users','=','users.id_users')
    				->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
    				->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
    				->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
    				->where('anggota.id_users',$id)
    				->firstOrFail();
    	return $get;
    }



    public static function getByKelasTahunAjaran($id_kelas,$id_tahun_ajaran) {
        $query = self::join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->where('anggota_perpus.id_kelas',$id_kelas)
                    ->where('anggota_perpus.id_tahun_ajaran',$id_tahun_ajaran)
                    ->where('anggota_perpus.status_delete',0)
                    ->where('anggota.status_delete',0)
                    ->get();

        return $query;
    }

    public static function getGuru()
    {
        $query = self::join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->join('users','anggota.id_users','=','users.id_users')
                    ->where('tipe_anggota','guru')
                    ->where('anggota.status_delete',0)
                    ->get();
                    
        return $query;
    }

    public static function getKaryawan()
    {
        $query = self::join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->join('users','anggota.id_users','=','users.id_users')
                    ->where('tipe_anggota','karyawan')
                    ->where('anggota.status_delete',0)
                    ->get();
                    
        return $query;
    }

    // public static function showAnggota($tipe) {
    //     if ($tipe == 'siswa') {
    //         $query = self::join('anggota','anggota_perpus.id_anggota_perpus','=','anggota.id_anggota')
    //                     ->join('users','anggota.id_users','=','users.id_users')
    //                     ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
    //                     ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
    //                     ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
    //                     ->where('tipe_anggota','siswa')
    //                     ->where('anggota_perpus.status_delete',0)
    //                     ->get();
    //     }
    //     else {
    //         $query = self::join('anggota','anggota_perpus.id_anggota_perpus','=','anggota.id_anggota')
    //                     ->join('users','anggota.id_users','=','users.id_users')
    //                     ->where('tipe_anggota','guru')
    //                     ->where('anggota_perpus.status_delete',0)
    //                     ->get();
    //     }
    // 	return $query;
    // }

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

    public static function getByIdKelas($id)
    {
        $get = self::join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->where('anggota_perpus.id_kelas',$id)
                    ->where('anggota_perpus.status_delete',0)
                    ->get();

        return $get;
    }
}
