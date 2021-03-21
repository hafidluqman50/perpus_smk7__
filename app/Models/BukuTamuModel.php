<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTamuModel extends Model
{
    // use HasFactory;

    protected $table      = 'buku_tamu';
    protected $primaryKey = 'id_buku_tamu';
    protected $guarded    = [];

    public static function getData()
    {
    	$get = self::join('anggota_perpus','buku_tamu.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
    				->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
    				->join('users','anggota.id_users','=','users.id_users')
    				->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
    				->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
    				->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                    ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
    				->get();

    	return $get;
    }

    public static function countByClass($class,$date)
    {
        $get = self::join('anggota_perpus','buku_tamu.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->where('kelas_tingkat',$class)
                    ->whereDate('tanggal_berkunjung',$date)
                    ->count();

        return $get;
    }

    public static function countTeacher($date)
    {
        $get = self::join('anggota_perpus','buku_tamu.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->where('kelas_tingkat','-')
                    ->whereDate('tanggal_berkunjung',$date)
                    ->count();
                    
        return $get;
    }

    public static function countPerDay($date)
    {
        $count = self::whereDate('tanggal_berkunjung',$date)
                      ->count();

        return $count;
    }

    public static function countTotalByClass($class,$get_month,$year)
    {
        if (strlen($get_month) == 1) {
            $month = '0'.(string)$get_month;
        }
        else {
            $month = $get_month;
        }
        $get = self::join('anggota_perpus','buku_tamu.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->where('kelas_tingkat',$class)
                    ->whereMonth('tanggal_berkunjung',$month)
                    ->whereYear('tanggal_berkunjung',$year)
                    ->count();

        return $get;
    }

    public static function countTotalTeacher($get_month,$year)
    {
        if (strlen($get_month) == 1) {
            $month = '0'.(string)$get_month;
        }
        else {
            $month = $get_month;
        }
        $get = self::join('anggota_perpus','buku_tamu.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->where('kelas_tingkat','-')
                    ->whereMonth('tanggal_berkunjung',$month)
                    ->whereYear('tanggal_berkunjung',$year)
                    ->count();

        return $get;
    }

    public static function countTotalAllPerMonth($get_month,$year)
    {
        if (strlen($get_month) == 1) {
            $month = '0'.(string)$get_month;
        }
        else {
            $month = $get_month;
        }
        $count = self::whereMonth('tanggal_berkunjung',$month)
                      ->whereYear('tanggal_berkunjung',$year)
                      ->count();

        return $count;
    }

    public static function countPerYear($month,$year)
    {
        $count = self::whereMonth('tanggal_berkunjung',$month)
                      ->whereYear('tanggal_berkunjung',$year)
                      ->count();

        return $count;
    }
}
