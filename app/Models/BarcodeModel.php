<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

class BarcodeModel extends Model
{
    protected $table      = 'barcode_scan';
    protected $primaryKey = 'id_barcode';
    protected $keyType    = 'string';
    protected $guarded    = [];
    public $incrementing  = false;
    public $timestamps    = false;

    public static function showData() {
    	$sql = self::join('buku','barcode_scan.id_buku','=','buku.id_buku')->get();
    	return $sql;
    }

    public function buku()
    {
        return $this->belongsTo('App\Models\BukuModel','id_buku');
    }

    public static function code($code) {
        $barcode = new BarcodeGenerator();
        $barcode->setText($code);
        $barcode->setType(BarcodeGenerator::Code39);
        $barcode->setScale(1);
        $barcode->setThickness(40);
        $barcode->setFontSize(10);
        $code = $barcode->generate();
        return $code;   
    }


    public static function getRow($id) {
    	$sql = self::join('buku','barcode_scan.id_buku','=','buku.id_buku')
    				->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
    				->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
    				->where('id_barcode',$id)
    				->firstOrFail();
    	return $sql;
    }

    public static function getBuku($code_scanner) {
        $sql = self::join('buku','barcode_scan.id_buku','=','buku.id_buku')
                    ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->where('code_scanner',$code_scanner)
                    ->firstOrFail();
        return $sql;
    }
}
