<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_buku';
    protected $guarded    = [];
    public $timestamps    = false;

    public static function showData() {
    	$data = self::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
    				->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
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
    				->limit(3)
    				->get();
    	return $data;	
    }

    public function showBySub($id) {
        $db = self::where('id_sub_ktg',$id)->get();
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

    public static function cekRating() {
        $db = self::join('rating_buku','buku.id_buku','=','rating_buku.id_buku')
                    ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->orderBy('rating')
                    ->limit(3)
                    ->get();
        return $db;
    }
}
