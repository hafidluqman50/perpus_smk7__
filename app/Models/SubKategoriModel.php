<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SubKategoriModel extends Model
{
    protected $table      = 'sub_kategori';
    protected $primaryKey = 'id_sub_ktg';
    protected $guarded    = [];
    public $timestamps    = false;

    public static function getBuku($slug,$slug_sub,$cari = '') {
        if ($cari == '') {
            $db = DB::table('buku')
                    ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->where('slug_kategori',$slug)
                    ->where('slug_sub_ktg',$slug_sub)
                    ->orderBy('id_buku','desc')
                    ->paginate(12);
        }
        else {
            $db = DB::table('buku')
                    ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->where('slug_kategori',$slug)
                    ->where('slug_sub_ktg',$slug_sub)
                    ->where('judul_buku','like','%'.$cari.'%')
                    ->orderBy('id_buku','desc')
                    ->paginate(12);
        }
        return $db;
    }

    public static function getIdSubKtg($slug_ktg,$slug_sub)
    {
        $get = self::join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->where('slug_kategori',$slug_ktg)
                    ->where('slug_sub_ktg',$slug_sub)
                    ->firstOrFail()
                    ->id_sub_ktg;

        return $get;
    }

    public static function findBySlug($slug,$slug_sub) {
        $db = self::where('slug_sub_ktg',$slug_sub);
        if ($db->count() > 0) {
            $result = $db->firstOrFail();
        } else {
            $result = '';
        }
        return $result;
    }

    public static function getFoto($slug,$slug_sub) {
        $db = DB::table('buku')
                ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                ->where('slug_kategori',$slug)
                ->where('slug_sub_ktg',$slug_sub)
                ->limit(4)
                ->select('foto_buku')
                ->orderBy('id_buku','desc')
                ->get();
        return $db;   
    }

    public function get_sub($id) {
        $db = DB::table('sub_kategori')
                ->where('id_kategori_buku',$id)
                ->get();
        return $db;
    }

    public function num_rows_sub($slug) {
        $db = DB::table('buku')
                ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                ->where('sub_kategori.slug_sub_ktg',$slug)
                ->count();
        return $db;
    }

    public static function getDataTables($id_ktg) {
        $db = self::join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                   ->where('sub_kategori.id_kategori_buku',$id_ktg)
                   ->get();
        return $db;        
    }

    public static function showKategori($id) {
        $db = self::where('id_kategori_buku',$id)
                   ->get();
        return $db;
    }
}
