<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubKategoriModel as SubKategori;
use App\Models\KategoriModel as Kategori;

class KategoriController extends Controller
{
    public function kategori($slug) 
    {
        $ktg           = new Kategori;
        $kategori      = $ktg->orderBy('id_kategori_buku','desc')->get();
        $sub_ktg       = new SubKategori;
        $val           = $ktg->getBuku($slug,request('cari'));
        $nama_kategori = $ktg->findBySlug($slug)->nama_kategori;
        $keterangan    = $ktg->findBySlug($slug)->deskripsi_kategori;
        $title         = $nama_kategori;
        $foto_kategori = $ktg->getFoto($slug);
        return view('Main.page.kategori',compact('title','ktg','kategori','sub_ktg','foto_kategori','nama_kategori','keterangan','val'));
    }

    public function subKategori($slug,$slug_sub) 
    {
        $ktg        = new Kategori;
        $kategori   = $ktg->orderBy('id_kategori_buku','desc')->get();
        $sub_ktg    = new SubKategori;
        $val        = $sub_ktg->getBuku($slug,$slug_sub,request('cari'));
        $nama_sub   = $sub_ktg->findBySlug($slug,$slug_sub)->nama_sub;
        $keterangan = $sub_ktg->findBySlug($slug,$slug_sub)->deskripsi_sub;
        $title      = $nama_sub;
        $foto_sub   = $sub_ktg->getFoto($slug,$slug_sub);
        return view('Main.page.sub-kategori',compact('title','ktg','kategori','sub_ktg','foto_sub','nama_sub','keterangan','val'));
    }

    public function cariBukuKategori($slug,Request $request)
    {
        // $cari = $request->cari;
        return $this->kategori($slug);
    }

    public function cariBukuSubKategori($slug,$slug_sub,Request $request)
    {
        // $cari = $request->cari;
        return $this->subKategori($slug,$slug_sub);
    }
}
