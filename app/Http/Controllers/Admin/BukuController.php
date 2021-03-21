<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BukuModel as Buku;
use App\Models\KategoriModel as Kategori;
use App\Models\SubKategoriModel as SubKategori;
use Intervention\Image\ImageManagerStatic as Image;

class BukuController extends Controller
{
    public function index() 
    {
        $title = 'Data Buku | Admin';
        $buku  = 'menu-open';
        $page  = 'data-buku';
        return view('Pengurus.Admin.page.buku.data-buku.main',compact('title','buku','page'));
    }

    public function tambah() 
    {
        $title    = 'Form Buku | Admin';
        $buku     = 'menu-open';
        $page     = 'data-buku';
        $kategori = Kategori::all();
        return view('Pengurus.Admin.page.buku.data-buku.form-buku',compact('title','buku','page','kategori'));
    }

    public function edit($id) 
    {
        $title    = 'Form Buku | Admin';
        $buku     = 'menu-open';
        $page     = 'data-buku';
        $row      = Buku::getData($id);
        $kategori = Kategori::all();
        $sub_ktg  = new SubKategori;
        return view('Pengurus.Admin.page.buku.data-buku.form-buku',compact('title','buku','page','kategori','sub_ktg','row'));   
    }

    public function delete($id) 
    {
        $get = Buku::where('id_buku',$id);
        $foto = $get->firstOrFail()->foto_buku;
        if (file_exists(public_path('front-assets/foto_buku/'.$foto))) {
            unlink(public_path('front-assets/foto_buku/'.$foto));
        }
        $get->delete();
        return redirect('/admin/data-buku')->with('message','Berhasil Hapus Buku');
    }

    public function save(Request $request) 
    {
        if (Buku::count() == 0) {
            $nomor_induk = 1;
        } else {
            $nomor_induk = Buku::orderBy('id_buku','desc')->firstOrFail()->nomor_induk+1;
        }
        $judul_buku       = $request->judul_buku;
        $judul_slug       = str_slug($judul_buku,'-');
        $sub_ktg          = $request->sub_ktg;
        $pengarang        = $request->pengarang;
        $penerbit         = $request->penerbit;
        $tahun_terbit     = $request->tahun_terbit;
        $tempat_terbit    = $request->tempat_terbit;
        $sn_penulis       = $request->sn_penulis;
        $jumlah_eksemplar = $request->jumlah_eksemplar;
        $klasifikasi      = $request->klasifikasi;
        $stok_buku        = $request->stok_buku;
        $foto_buku        = $request->foto_buku;
        $fileName         = $foto_buku != '' ?uniqid('_foto_buku_').$foto_buku->getClientOriginalName():'-';
        $keterangan       = $request->keterangan;
        $id               = $request->id_buku;
        if ($id == '') {
            if ($foto_buku != '') {
                Image::make($foto_buku)->resize(446,446)->save('front-assets/foto_buku/'.$fileName);
            }
            $array = [
                'tanggal_upload'   => date('Y-m-d'),
                'nomor_induk'      => $nomor_induk,
                'judul_buku'       => $judul_buku,
                'judul_slug'       => $judul_slug,
                'pengarang'        => $pengarang,
                'sn_penulis'       => $sn_penulis,
                'penerbit'         => $penerbit,
                'tempat_terbit'    => $tempat_terbit,
                'tahun_terbit'     => $tahun_terbit,
                'id_sub_ktg'       => $sub_ktg,
                'klasifikasi'      => $klasifikasi,
                'jumlah_eksemplar' => $jumlah_eksemplar,
                'stok_buku'        => $stok_buku,
                'foto_buku'        => $fileName,
                'keterangan'       => $keterangan
            ];
            Buku::create($array);
            $message = 'Berhasil Input Buku';
        } else {
            $get = Buku::where('id_buku',$id);
            if ($foto_buku != '') {
                $foto = $get->firstOrFail()->foto_buku;
                if (file_exists(public_path('front-assets/foto_buku/'.$foto))) {
                    unlink(public_path('front-assets/foto_buku/'.$foto));
                }
                Image::make($foto_buku)->resize(446,446)->save('front-assets/foto_buku/'.$fileName);
                $array = [
                    'tanggal_upload'   => date('Y-m-d'),
                    'nomor_induk'      => $nomor_induk,
                    'judul_buku'       => $judul_buku,
                    'judul_slug'       => $judul_slug,
                    'pengarang'        => $pengarang,
                    'sn_penulis'       => $sn_penulis,
                    'penerbit'         => $penerbit,
                    'tempat_terbit'    => $tempat_terbit,
                    'tahun_terbit'     => $tahun_terbit,
                    'id_sub_ktg'       => $sub_ktg,
                    'klasifikasi'      => $klasifikasi,
                    'jumlah_eksemplar' => $jumlah_eksemplar,
                    'stok_buku'        => $stok_buku,
                    'foto_buku'        => $fileName,
                    'keterangan'       => $keterangan
                ];
            }
            else {
                $array = [
                    'tanggal_upload'   => date('Y-m-d'),
                    'nomor_induk'      => $nomor_induk,
                    'judul_buku'       => $judul_buku,
                    'judul_slug'       => $judul_slug,
                    'pengarang'        => $pengarang,
                    'sn_penulis'       => $sn_penulis,
                    'penerbit'         => $penerbit,
                    'tempat_terbit'    => $tempat_terbit,
                    'tahun_terbit'     => $tahun_terbit,
                    'id_sub_ktg'       => $sub_ktg,
                    'klasifikasi'      => $klasifikasi,
                    'jumlah_eksemplar' => $jumlah_eksemplar,
                    'stok_buku'        => $stok_buku,
                    'keterangan'       => $keterangan
                ];
            }
            $get->update($array);
            $message = 'Berhasil Update Buku';
        }
        return redirect('/admin/data-buku')->with('message',$message);
    }

    public function importBuku(Request $request) 
    {
        //
    }
    
    public function cetakLaporan() 
    {
        //
    }
}
