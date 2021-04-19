<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class TransaksiDetailModel extends Model
{
    protected $table      = 'detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    protected $guarded    = [];

    public static function showData($id) {
    	$db = self::join('buku','detail_transaksi.id_buku','=','buku.id_buku')
    				->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
    				->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
    				->where('id_transaksi',$id)
    				// ->orderBy('status_transaksi','desc')
    				->get();
    	return $db;
    }

    // public static function countPinjamBukuK13($kelas,$jurusan,$urutan_kelas,$tahun_ajaran) {
    //     DB::enableQueryLog();
    //     $get = self::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
    //                 ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
    //                 ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
    //                 ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
    //                 ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
    //                 ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
    //                 ->join('buku','detail_transaksi.id_buku','=','buku.id_buku')
    //                 ->where('kelas_tingkat','XII')
    //                 ->where('nama_jurusan','RPL')
    //                 ->where('urutan_kelas',1)
    //                 ->where('tahun_ajaran','2021/2022')
    //                 ->where('jenis_buku','buku-pelajaran-kelas-xii')
    //                 ->groupBy('transaksi_buku.id_anggota_perpus')
    //                 ->count();

    //     dd(DB::getQueryLog());
    //     dd($get);
    //     return $get;
    // }

    public static function checkPinjamBukuK13($id_anggota,$kelas)
    {
        $db = self::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                ->join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                ->where('id_anggota_perpus',$id_anggota)
                ->where('jenis_buku','=','buku-pelajaran-kelas-'.strtolower($kelas))
                ->count();

        if ($db > 0) {
            $return = 'true';
        }
        else {
            $return = 'false';
        }

        return $return;
    }

    public static function checkTidakPinjamBukuK13($id_anggota,$kelas)
    {
        $db = self::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                ->join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                ->where('id_anggota_perpus',$id_anggota)
                ->where('jenis_buku','=','buku-pelajaran-kelas-'.strtolower($kelas))
                ->count();

        if ($db > 0) {
            $return = 'false';
        }
        else {
            $return = 'true';
        }

        return $return;
    }

    public static function countNotExistsPinjamK13($kelas,$jurusan,$urutan_kelas,$tahun_ajaran) 
    {
        // DB::enableQueryLog();
        $get = DB::table('anggota_perpus')
                ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
                ->whereNotExists(function($query) {
                    $query->from('transaksi_buku')
                          ->whereRaw('transaksi_buku.id_anggota_perpus = anggota_perpus.id_anggota_perpus');
                })
                ->where('tipe_anggota','siswa')
                ->where('kelas_tingkat',$kelas)
                ->where('nama_jurusan',$jurusan)
                ->where('urutan_kelas',$urutan_kelas)
                ->where('tahun_ajaran',$tahun_ajaran[0].'/'.$tahun_ajaran[1])
                ->count();
        // $get = self::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
        //             ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
        //             ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
        //             ->whereNotExists(function($query){
        //                 $query->from('buku')
        //                         ->where('jenis_buku','buku-pelajaran-kelas-xii')
        //                         ->whereRaw('detail_transaksi.id_buku = buku.id_buku');
        //             })
        //             ->get();
        // dd(DB::getQueryLog());
        // dd($get);
        return $get;
    }

    public static function countPeminjaman($status,$date)
    {
        if ($status == 'sedang-dipinjam') {
            $date_field = 'tanggal_pinjam';
        }
        else {
            $date_field = 'tanggal_kembali';
        }

        $db = self::where('status_transaksi',$status)
                    ->whereDate($date_field,$date)
                    ->count();

        return $db;
    }

    public static function countTotalPerMonth($status,$get_month,$year)
    {
        if (strlen($get_month) == 1) {
            $month = '0'.(string)$get_month;
        }
        else {
            $month = $get_month;
        }

        if ($status == 'sedang-dipinjam') {
            $date_field = 'tanggal_pinjam';
        }
        else {
            $date_field = 'tanggal_kembali';
        }

        $db = self::where('status_transaksi',$status)
                    ->whereMonth($date_field,$month)
                    ->whereYear($date_field,$year)
                    ->count();

        return $db;
    }

    public static function countPinjamPerYear($month,$year)
    {
        $count = self::whereMonth('tanggal_pinjam',$month)
                      ->whereYear('tanggal_pinjam',$year)
                      ->where('status_transaksi','sedang-dipinjam')
                      ->count();

        return $count;
    }

    public static function countKembaliPerYear($month,$year)
    {
        $count = self::whereMonth('tanggal_pinjam',$month)
                      ->whereYear('tanggal_pinjam',$year)
                      ->where('status_transaksi','kembali')
                      ->count();

        return $count;
    }

    public static function checkPinjam($id_user) {
        $db = self::join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                    ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->join('users','anggota.id_users','=','users.id_users')
                    ->whereNotIn('kategori_buku.id_kategori_buku',[1])
                    ->where('anggota.id_users',$id_user)
                    ->whereIn('status_transaksi',['pending','sedang-dipinjam'])
                    ->count();
        return $db;
    }

    public static function getRowKonfirmasi($id,$id_detail)
    {
        $get = self::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->where('detail_transaksi.id_transaksi',$id)
                    ->where('id_detail_transaksi',$id_detail)
                    ->firstOrFail();

        return $get;
    }

    public static function konfirmasi($id,$id_detail)
    {
        $get = self::where('id_transaksi',$id)->where('id_detail_transaksi',$id_detail);
                    // ->update(['status_transaksi' => 'sedang-dipinjam','']);
    }

    public static function rowDetailPinjam($id,$id_anggota_perpus) {
        $db = self::join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                    ->join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
                    ->where('detail_transaksi.id_detail_transaksi',$id)
                    ->where('transaksi_buku.id_anggota_perpus',$id_anggota_perpus)
                    ->firstOrFail();
        return $db;
    }

    public static function getTransaksi($id,$id_detail) {
    	$db = self::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
    				->where('detail_transaksi.id_transaksi',$id)
                    ->where('id_detail_transaksi',$id_detail)
                    ->get();
    	return $db;
    }

    public static function getRowDetail($id,$id_detail) {
        $db = self::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->where('detail_transaksi.id_transaksi',$id)
                    ->where('id_detail_transaksi',$id_detail)
                    ->firstOrFail();

        return $db;
    }

    public static function cekKtg($id_anggota,$id_ktg) {
        $db = self::join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                    ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->where('transaksi_buku.id_anggota_perpus',$id_anggota);
        if ($id_ktg == '1') {
            $result = $db->where('kategori_buku.id_kategori_buku','1')->count();
            if ($result >= 0) {
                return true;
            }
        }
        else {
            $result = $db->where('kategori_buku.id_kategori_buku',$id_ktg)->count();
            if ($result > 0) {
                return false;
            }
            else {
                return true;
            }
        }
    }

    public static function showBukuPinjam($id_anggota_perpus) {
        $db = self::join('buku','detail_transaksi.id_buku','=','buku.id_buku')  
                    ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->where('transaksi_buku.id_anggota_perpus',$id_anggota_perpus)
                    ->whereNotIn('kategori_buku.id_kategori_buku',[1])
                    ->firstOrFail();
        return $db;
    }

    public static function peminjam($value) {
        $db = self::join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                    ->join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
                    ->where('code_scanner',$value)
                    ->firstOrFail();
        // dd($db);
        return $db;
    }

    public static function cekTransaksi($anggota) {
        $db = self::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                    ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->where('anggota_perpus.id_anggota',$anggota)
                    ->whereNotIn('kategori_buku.id_kategori_buku',[1])
                    ->whereIn('status_transaksi',['sedang-dipinjam','pending'])
                    ->count();
        return $db;
    }

    public static function getTransaksiByAnggota($anggota)
    {
        $get = self::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('buku','detail_transaksi.id_buku','=','buku.id_buku')
                    ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->where('anggota_perpus.id_anggota',$anggota)
                    ->get();
        return $get;
    }

    public static function cekPinjam($id_buku,$id_anggota,$barcode) {
        $db = self::join('transaksi','detail_transaksi.id_transaksi','=','transaksi.id_transaksi')->get();
        return $db;
    }

    public static function checkBuku($anggota,$code_scanner,$id_buku) 
    {
        $get = self::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                    ->where('id_anggota_perpus',$anggota)
                    ->where('id_buku',$id_buku)
                    ->firstOrFail();
        // dd($get);

        if ($get->code_scanner != $code_scanner) {
            $statement = false;
        }
        else {
            $statement = true;
        }

        return $statement;
    }
}
