<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BarcodeModel as Barcode;
use App\Models\KategoriModel as Kategori;
use App\Models\SubKategoriModel as SubKategori;
use App\Models\BukuModel as Buku;

class BarcodeController extends Controller
{
	public function index() 
	{
		$title = 'Barcode | Admin';
		$page  = 'barcode';
		$buku  = 'menu-open active';
		return view('Pengurus.Admin.page.buku.barcode.main',compact('title','page','buku'));
	}

	public function tambah() 
	{
		$title = 'Form Barcode | Admin';
		$page  = 'barcode';
		$buku  = 'menu-open active';
		$kategori = Kategori::all();
		return view('Pengurus.Admin.page.buku.barcode.form-barcode',compact('title','page','buku','kategori'));
	}

	public function edit($id) 
	{
		$title    = 'Form Barcode | Admin';
		$page     = 'barcode';
		$buku     = 'menu-open active';
		$kategori = Kategori::all();
		$sub_ktg  = new SubKategori;
		$buku     = new Buku;
		$row      = Barcode::getRow($id);
		// dd($row->id_sub_ktg);
		return view('Pengurus.Admin.page.buku.barcode.form-barcode',compact('title','page','buku','kategori','sub_ktg','buku','row'));
	}

	public function delete($id) 
	{
		Barcode::where('id_barcode',$id)->delete();
		return redirect('/admin/barcode-buku')->with('message','Berhasil Hapus Barcode');
	}

	public function save(Request $request) 
	{
		$code_barcode = $request->code_barcode;
		$buku         = $request->buku;
		$kode_buku    = kode_buku(100);
		$id           = $request->id_barcode;
		$array = [
			'code_scanner' => $code_barcode,
			'id_buku'      => $buku,
			'kode_buku'    => $kode_buku
		];
		if ($id == '') {
			Barcode::create($array);
			$message = 'Berhasil Input Barcode';
		} else {
			Barcode::where('id_barcode',$id)->update($array);
			$message = 'Berhasil Update Barcode';
		}
		return redirect('/admin/barcode-buku')->with('message',$message);
	}
}
