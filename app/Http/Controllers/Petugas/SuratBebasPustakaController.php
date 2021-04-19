<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaranModel as TahunAjaran;
use App\Models\SuratBebasPustakaModel as SuratBebasPustaka;
use Illuminate\Http\Request;

class SuratBebasPustakaController extends Controller
{
    public function index()
    {
		$title = 'Surat Bebas Pustaka';
		$buku  = 'menu-open';
		$page  = 'surat-bebas-pustaka';

    	return view('Pengurus.Admin.page.buku.surat-bebas-pustaka.main',compact('title','page','buku'));
    }

    public function tambah()
    {
		$title        = 'Surat Bebas Pustaka';
		$buku         = 'menu-open';
		$page         = 'surat-bebas-pustaka';
		$tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();

		return view('Pengurus.Admin.page.buku.surat-bebas-pustaka.form-surat-bebas-pustaka',compact('title','page','buku','tahun_ajaran'));
	}

    public function edit($id)
    {
		$title        = 'Surat Bebas Pustaka';
		$buku         = 'menu-open';
		$page         = 'surat-bebas-pustaka';
		$tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();
		$row          = SuratBebasPustaka::where('id_surat_bebas_pustaka',$id)->firstOrFail();

		return view('Pengurus.Admin.page.buku.surat-bebas-pustaka.form-surat-bebas-pustaka',compact('title','page','buku','tahun_ajaran','row'));
    }

    public function save(Request $request)
    {
		$nomor_surat  = $request->nomor_surat;
		$tahun_ajaran = $request->tahun_ajaran;
		$id_surat     = $request->id_surat_bebas_pustaka;

		$data_nomor_surat = [
			'nomor_surat'     => $nomor_surat,
			'id_tahun_ajaran' => $tahun_ajaran
		];

		if ($id_surat == '') {
			$message = 'Berhasil Input Data';

			SuratBebasPustaka::create($data_nomor_surat);
		}
		else {
			$message = 'Berhasil Edit Data';

			SuratBebasPustaka::where('id_surat_bebas_pustaka',$id_surat)
							->update($data_nomor_surat);
		}

		return redirect('/admin/surat-bebas-pustaka')->with('message',$message);
    }

    public function delete($id)
    {
    	SuratBebasPustaka::where('id_surat_bebas_pustaka',$id)->delete();

    	return redirect('/admin/surat-bebas-pustaka')->with('message','Berhasil Hapus Data');
    }
}
