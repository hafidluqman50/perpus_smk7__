<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AturanPinjamModel as AturanPinjam;

class AturanPinjamController extends Controller
{
    public function index()
    {
		$title = 'Aturan Pinjam | Admin';
		$page  = 'aturan-pinjam';

		return view('Pengurus.Admin.page.aturan-pinjam.main',compact('title','page'));
    }

    public function tambah()
    {
    	if (AturanPinjam::count() > 0) {
    		$return = redirect('/admin/aturan-pinjam')->with('message','Data Hanya Bisa 1 Data');
    	}
    	else {
			$title = 'Form Aturan Pinjam | Admin';
			$page  = 'aturan-pinjam';

	    	$return = view('Pengurus.Admin.page.aturan-pinjam.form-aturan-pinjam',compact('title','page'));
    	}

    	return $return;
    }

    public function edit($id)
    {
		$title = 'Form Aturan Pinjam | Admin';
		$page  = 'aturan-pinjam';
		$row   = AturanPinjam::where('id_aturan_pinjam',$id)->firstOrFail();

		return view('Pengurus.Admin.page.aturan-pinjam.form-aturan-pinjam',compact('title','page','row'));
    }

    public function delete($id)
    {
    	AturanPinjam::where('id_aturan_pinjam',$id)->delete();

    	return redirect('/admin/aturan-pinjam')->with('message','Berhasil Hapus Data');
    }

    public function save(Request $request)
    {
		$isi_aturan = $request->isi_aturan;
		$id         = $request->id_aturan_pinjam;

    	$data_aturan_pinjam = [
    		'isi_aturan' => $isi_aturan
    	];

    	if ($id == '') {
    		AturanPinjam::create($data_aturan_pinjam);
    		$message = 'Berhasil Input Data';
    	}
    	else {
    		AturanPinjam::where('id_aturan_pinjam',$id)->update($data_aturan_pinjam);
    		$message = 'Berhasil Update Data';
    	}

    	return redirect('/admin/aturan-pinjam')->with('message',$message);
    }
}
