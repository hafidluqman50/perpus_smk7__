<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_buku';
    protected $guarded    = [];
    public $timestamps    = false;

    public static function showData() {
    	$data = self::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
    				->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->where('buku.status_delete',0)
    				->get();
    	return $data;
    }

    public static function getData($id) {
        $data = self::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->where('id_buku',$id)
                    ->firstOrFail();
        return $data;
    }

    public function newestBook() {
    	$data = self::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
    				->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
    				->orderBy('tanggal_upload','desc')
                    ->where('buku.status_delete',0)
    				->limit(3)
    				->get();
    	return $data;	
    }

    public function showBySub($id) {
        $db = self::where('id_sub_ktg',$id)->where('status_delete',0)->get();
        // dd($db);
        return $db;
    }

    public static function getIdKtg($id) {
        $db = self::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->where('id_buku',$id)
                    ->firstOrFail()->id_kategori_buku;
        return $db;
    }

    public static function showMostPopular() {
        // DB::enableQueryLog();
        $db = self::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->join('detail_transaksi','buku.id_buku','=','detail_transaksi.id_buku')
                    ->select(['buku.*','kategori_buku.*','sub_kategori.*',DB::raw('count(*) as hitung_populer')])
                    ->orderBy('hitung_populer','DESC')
                    ->groupBy('detail_transaksi.id_buku')
                    ->where('buku.status_delete',0)
                    ->limit(3)
                    ->get();

        // dd(DB::getQueryLog());
        return $db;
    }
}
