<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class KategoriModel extends Model
{
    protected $table      = 'kategori_buku';
    protected $primaryKey = 'id_kategori_buku';
    protected $guarded    = [];
    public $timestamp     = false;

    public static function getBuku($slug) {
    	$db = DB::table('buku')
                ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
    			->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                ->orderBy('id_buku','desc')
    			->where('slug_kategori',$slug)
                ->paginate(12);
        return $db;
    }

    public static function findBySlug($slug) {
        $db = self::where('slug_kategori',$slug);
        if ($db->count() > 0) {
            $result = $db->firstOrFail();
        } else {
            $result = '';
        }
        return $result;
    }

    public static function getFoto($slug) {
        $db = DB::table('buku')
                ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                ->orderBy('id_buku','desc')
                ->select('foto_buku')
                ->limit(4)
                ->where('slug_kategori',$slug)
                ->get();
        return $db;
    }

    public function num_rows_kategori($slug) {
        $db = DB::table('buku')
                ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                ->select('buku.*','kategori_buku.*')
                ->where('kategori_buku.slug_kategori',$slug)
                ->count();
        return $db;
    }
}
