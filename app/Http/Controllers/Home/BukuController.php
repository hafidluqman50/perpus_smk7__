<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BukuModel as Buku;
use App\Models\KategoriModel as Kategori;
use App\Models\SubKategoriModel as SubKategori;
use App\Models\AnggotaModel as Anggota;
use App\Models\TransaksiDetailModel as TransaksiDetail;
use DB;
use Auth;

class BukuController extends Controller
{
    public function buku() 
    {
        $title    = 'Buku';
        $ktg      = new Kategori;
        $kategori = $ktg->orderBy('id_kategori_buku','desc')
                     ->where('status_delete',0)->get();
        $sub_ktg  = new SubKategori;
        if (request('cari') == '') {
        $buku = Buku::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                     ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                     ->select('buku.*','sub_kategori.nama_sub','sub_kategori.slug_sub_ktg','kategori_buku.nama_kategori','kategori_buku.slug_kategori')
                     ->where('buku.status_delete',0)
                     ->paginate(12);
        }
        else {
        $buku = Buku::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                     ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                     ->select('buku.*','sub_kategori.nama_sub','sub_kategori.slug_sub_ktg','kategori_buku.nama_kategori','kategori_buku.slug_kategori')
                     ->where('judul_buku','like','%'.request('cari').'%')
                     ->where('buku.status_delete',0)
                     ->paginate(12);
        }

        if (Auth::check() && Auth::user()->status_akun == 1) {
            $anggota   = Anggota::where('id_users',Auth::id())->firstOrFail()->id_anggota;
            $cek       = TransaksiDetail::cekTransaksi($anggota);
           return view('Main.page.buku',compact('title','ktg','kategori','sub_ktg','buku','cek','anggota'));
        }
        else {
            Auth::check() ? Auth::logout() : '';
    	   return view('Main.page.buku',compact('title','ktg','kategori','sub_ktg','buku'));
        }
    }

    public function detailBuku($slug) 
    {
        $get = Buku::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                    ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                    ->where('judul_slug',$slug);
        $buku = $get->first();
    	if ($get->count() == 0) {
    		return view('errors.404');
    	}
    	$title = $buku->judul_buku;
    	return view('Main.page.detail-buku',compact('title','buku'));
    }

    public function cariBuku(Request $request)
    {
        $cari = $request->cari;
        return $this->buku();
    }
}
