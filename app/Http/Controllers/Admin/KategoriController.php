<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KategoriModel as Kategori;
use App\Models\SubKategoriModel as SubKategori;

class KategoriController extends Controller
{
    public function kategori() 
    {
        $title = 'Data Kategori | Admin';
        $buku  = 'menu-open';
        $page  = 'kategori-buku';
        return view('Pengurus.Admin.page.buku.kategori-buku.main',compact('title','page','buku'));
    }

    public function tambahKategori() 
    {
        $title = 'Form Kategori | Admin';
        $buku  = 'menu-open';
        $page  = 'kategori-buku';
        return view('Pengurus.Admin.page.buku.kategori-buku.form-kategori',compact('title','page','buku'));
    }

    public function editKategori($id) 
    {
        $title = 'Form Kategori | Admin';
        $buku  = 'menu-open';
        $page  = 'kategori-buku';
        $row = Kategori::where('id_kategori_buku',$id)->firstOrFail();
        return view('Pengurus.Admin.page.buku.kategori-buku.form-kategori',compact('title','page','buku','row'));
    }

    public function deleteKategori($id) 
    {
        Kategori::where('id_kategori_buku',$id)->delete();
        return redirect('/admin/kategori-buku')->with('message','Berhasil Hapus Kategori');
    }

    public function saveKategori(Request $request) 
    {
        $nama_kategori = $request->nama_kategori;
        $deskripsi     = $request->deskripsi_kategori;
        $id            = $request->id_kategori_buku;
        $array = [
            'nama_kategori'      => $nama_kategori,
            'slug_kategori'      => str_slug($nama_kategori,'-'),
            'deskripsi_kategori' => $deskripsi,
        ];
        if ($id == '') {
            Kategori::create($array);
            $message = 'Berhasil Input Kategori';
        } else {
            Kategori::where('id_kategori_buku',$id)->update($array);
            $message = 'Berhasil Update Kategori';
        }
        return redirect('/admin/kategori-buku')->with('message',$message);
    }

    public function subKategori($id) 
    {
        $kategori = Kategori::where('id_kategori_buku',$id)->firstOrFail();
        $title    = 'Sub Kategori | Admin';
        $buku     = 'menu-open';
        $page     = 'kategori-buku';
        return view('Pengurus.Admin.page.buku.kategori-buku.sub-kategori',compact('title','page','kategori','buku','id'));
    }

    public function tambahSubKategori($id) 
    {
        $title    = 'Form Sub Kategori | Admin';
        $buku     = 'menu-open';
        $page     = 'kategori-buku';
        return view('Pengurus.Admin.page.buku.kategori-buku.form-sub-kategori',compact('title','page','buku','id'));
    }

    public function editSubKategori($id,$id_sub) 
    {
        $title    = 'Form Sub Kategori | Admin';
        $buku     = 'menu-open';
        $page     = 'kategori-buku';
        $row      = SubKategori::where('id_sub_ktg',$id_sub)->firstOrFail();
        return view('Pengurus.Admin.page.buku.kategori-buku.form-sub-kategori',compact('title','page','buku','row','id'));
    }

    public function deleteSubKategori($id,$id_sub) 
    {
        SubKategori::where('id_kategori_buku',$id)->where('id_sub_ktg',$id_sub)->delete();
        return redirect('/admin/kategori-buku')->with('message','Berhasil Hapus Sub Kategori');
    }

    public function saveSubKategori(Request $request) 
    {
        $nama_sub  = $request->nama_sub;
        $kategori  = $request->kategori;
        $deskripsi = $request->deskripsi_sub;
        $id        = $request->id_sub_ktg;
        $array = [
            'nama_sub'         => $nama_sub,
            'slug_sub_ktg'     => str_slug($nama_sub,'-'),
            'id_kategori_buku' => $kategori,
            'deskripsi_sub'    => $deskripsi
        ];
        if ($id == '') {
            SubKategori::create($array);
            $message = 'Berhasil Input Sub Kategori';
        } else {
            SubKategori::where('id_sub_ktg',$id)->update($array);
            $message = 'Berhasil Update Sub Kategori';
        }
        return redirect('/admin/sub-kategori/'.$kategori)->with('message',$message);
    }
}
