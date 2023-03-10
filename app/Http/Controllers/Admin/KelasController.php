<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AnggotaModel as Anggota;
use App\Models\AnggotaPerpusModel as AnggotaPerpus;
use App\Models\TahunAjaranModel as TahunAjaran;
use App\Models\KelasTingkatModel as KelasTingkat;
use App\Models\JurusanModel as Jurusan;
use App\Models\KelasModel as Kelas;

class KelasController extends Controller
{
    public function index()
    {
      $title   = 'Data Kelas | Admin';
      $anggota = 'menu-open';
      $page    = 'data-kelas';
      return view('Pengurus.Admin.page.anggota.kelas.main',compact('title','anggota','page'));
    }

    public function tambah()
    {
		$title         = 'Form Kelas | Admin';
		$anggota       = 'menu-open';
		$page          = 'data-kelas';
		$kelas_tingkat = KelasTingkat::whereNotIn('id_kelas_tingkat',[1])->get();
		$jurusan       = Jurusan::whereNotIn('id_jurusan',[1])->get();
		return view('Pengurus.Admin.page.anggota.kelas.form-kelas',compact('title','anggota','page','jurusan','kelas_tingkat'));
    }

    public function edit($id)
    {
		$title         = 'Form Kelas | Admin';
		$anggota       = 'menu-open';
		$page          = 'data-kelas';
		$kelas_tingkat = KelasTingkat::whereNotIn('id_kelas_tingkat',[1])->get();
		$jurusan       = Jurusan::whereNotIn('id_jurusan',[1])->get();
		$row           = Kelas::where('id_kelas',$id)->firstOrFail();
		return view('Pengurus.Admin.page.anggota.kelas.form-kelas',compact('title','anggota','page','jurusan','kelas_tingkat','row'));
    }

    public function delete($id)
    {
		Kelas::where('id_kelas',$id)->update(['status_delete' => 1]);
		return redirect('/admin/kelas')->with('message','Berhasil Hapus Kelas');
    }


    public function save(Request $request)
    {
		$id_kelas_tingkat = $request->id_kelas_tingkat;
		$id_jurusan       = $request->id_jurusan;
		$urutan_kelas     = $request->urutan_kelas;
		$id               = $request->id_kelas;

		$kelas = [
			'id_kelas_tingkat' => $id_kelas_tingkat,
			'id_jurusan'       => $id_jurusan,
			'urutan_kelas'     => $urutan_kelas,
			'status_delete'	   => 0,
		];

		if ($id == '') {
			Kelas::create($kelas);
			$message = 'Berhasil Input Kelas';
		}
		else {
			Kelas::where('id_kelas',$id)->update($kelas);
			$message = 'Berhasil Update Kelas';
		}

		return redirect('/admin/kelas')->with('message',$message);
    }

    public function detail($id)
    {
		$title   = 'Kelas Detail | Admin';
		$anggota = 'menu-open';
		$page    = 'data-kelas';
		return view('Pengurus.Admin.page.anggota.kelas.kelas-detail.detail',compact('title','anggota','page','id'));
    }

    public function tambahDetail($id)
    {
		$title        = 'Form Kelas Detail | Admin';
		$anggota      = 'menu-open';
		$page         = 'data-kelas';
		$siswa        = Anggota::where('tipe_anggota','siswa')->where('status_delete',0)->get();
		$tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->where('status_delete',0)->get();
		$kelas        = Kelas::getById($id);
		return view('Pengurus.Admin.page.anggota.kelas.kelas-detail.form-kelas-detail',compact('title',
			'anggota','page','id','siswa','tahun_ajaran','kelas'));
    }

    public function editDetail($id,$id_detail)
    {
		$title        = 'Form Kelas Detail | Admin';
		$anggota      = 'menu-open';
		$page         = 'data-kelas';
		$siswa        = Anggota::where('id_anggota',$id_detail)->firstOrFail();
		$tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();
		$kelas        = Kelas::getById($id);
		$row          = AnggotaPerpus::where('id_kelas',$id)->where('id_anggota',$id_detail)->firstOrFail();

		return view('Pengurus.Admin.page.anggota.kelas.kelas-detail.form-kelas-detail-edit',compact('title','page','anggota','id','id_detail','siswa','tahun_ajaran','kelas','row'));
    }

    public function deleteDetail($id,$id_detail)
    {
    	AnggotaPerpus::where('id_kelas',$id)
					->where('id_anggota',$id_detail)
					->update(['status_delete' => 1]);

		return redirect('/admin/kelas/detail/'.$id)->with('message','Berhasil Hapus Data');
    }

    public function saveDetail(Request $request)
    {
		$siswa           = $request->siswa;
		$id_kelas        = $request->id_kelas;
		$id_tahun_ajaran = $request->id_tahun_ajaran;
		$form 			 = $request->form;

		if ($form == 'tambah') {
	    	for ($i=0; $i < count($siswa); $i++) { 
	    		$data_siswa[] = [
					'id_anggota'      => $siswa[$i],
					'id_kelas'        => $id_kelas,
					'id_tahun_ajaran' => $id_tahun_ajaran,
					'status_delete'   => 0
	    		];
	    	}

    		AnggotaPerpus::insert($data_siswa);

    		$message = 'Berhasil Input Data';
		}
		else {
			$data_siswa = [
				'id_tahun_ajaran' => $id_tahun_ajaran
			];

			AnggotaPerpus::where('id_kelas',$id_kelas)->where('id_anggota',$siswa)->update($data_siswa);

			$message = 'Berhasil Update Data';
		}

    	return redirect('/admin/kelas/detail/'.$id_kelas)->with('message',$message);
    }
}
