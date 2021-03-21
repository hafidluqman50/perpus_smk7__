<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi_buku';
    protected $primaryKey = 'id_transaksi';
    protected $guarded    = [];

    public static function showData($jenis) {
        $sql = self::join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                    ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
                    ->where('tipe_anggota',$jenis)
                    ->get();
    	return $sql;
    }

    public static function getTipeAnggotaById($id)
    {
        $sql = self::join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->where('id_transaksi',$id)
                    ->firstOrFail()
                    ->tipe_anggota;
        return $sql;
    }

    public static function siswaTrans($id) {
        $db = self::join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                    ->where('id_transaksi',$id)
                    ->firstOrFail();
        return $db;
    }

    public static function guruTrans($id) {
        //
    }
}
