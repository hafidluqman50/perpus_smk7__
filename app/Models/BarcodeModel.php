<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarcodeModel extends Model
{
    protected $table      = 'barcode_scan';
    protected $primaryKey = 'id_barcode';
    protected $guarded    = [];
    public $timestamps    = false;

    public static function showData() {
    	$sql = self::join('buku','barcode_scan.id_buku','=','buku.id_buku')->get();
    	return $sql;
    }

    public static function getRow($id) {
    	$sql = self::join('buku','barcode_scan.id_buku','=','buku.id_buku')
    				->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
    				->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
    				->where('id_barcode',$id)
    				->firstOrFail();
    	return $sql;
    }

    public static function getBuku($kode_buku) {
        $sql = self::join('buku','barcode_scan.id_buku','=','buku.id_buku')
                    ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->where('kode_buku',$kode_buku)
                    ->firstOrFail();
        return $sql;
    }
}
