<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\BukuModel as Buku;
use App\Models\BukuRusakModel as BukuRusak;
use Illuminate\Http\Request;

class BukuRusakController extends Controller
{
    public function index()
    {
		$title = 'Data Buku Rusak';
		$page  = 'data-buku-rusak';
		$buku  = 'menu-open';

		return view('Pengurus.Petugas.page.buku.data-buku-rusak.main',compact('title','page','buku'));
    }

    public function tambah()
    {
		$title     = 'Form Buku Rusak';
		$page      = 'data-buku-rusak';
		$buku      = 'menu-open';
		$data_buku = Buku::all();

		return view('Pengurus.Petugas.page.buku.data-buku-rusak.form-buku-rusak',compact('title','page','buku','data_buku'));
    }

    public function edit($id)
    {
		$title     = 'Form Buku Rusak';
		$page      = 'data-buku-rusak';
		$buku      = 'menu-open';
		$data_buku = Buku::all();
		$row       = BukuRusak::where('id_buku_rusak',$id)->firstOrFail();

		return view('Pengurus.Petugas.page.buku.data-buku-rusak.form-buku-rusak',compact('title','page','buku','data_buku','row'));
    }

    public function save(Request $request)
    {
		$buku          = $request->buku;
		$stok_rusak    = $request->stok_rusak;
		$keterangan    = $request->keterangan;
		$id_buku_rusak = $request->id_buku_rusak;

		$data_buku_rusak = [
			'id_buku'        => $buku,
			'stok_rusak'     => $stok_rusak,
			'ket_buku_rusak' => $keterangan
		];

		if ($id_buku_rusak == '') {
			$message = 'Berhasil Input Buku Rusak';

			BukuRusak::create($data_buku_rusak);
		}
		else {
			$message = 'Berhasil Update Buku Rusak';

			BukuRusak::where('id_buku_rusak',$id_buku_rusak)
					  ->update($data_buku_rusak);
		}

		return redirect('/petugas/data-buku-rusak')->with('message',$message);
    }

    public function delete($id)
    {
    	BukuRusak::where('id_buku_rusak',$id)->delete();

    	return redirect('/petugas/data-buku-rusak')->with('message','Berhasil Hapus Data');
    }
}
