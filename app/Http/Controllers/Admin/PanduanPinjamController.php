<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PanduanPinjamModel as PanduanPinjam;
use Image;

class PanduanPinjamController extends Controller
{
	public function index()
	{
		$title = 'Panduan Pinjam | Admin';
		$page  = 'panduan-pinjam';

		return view('Pengurus.Admin.page.panduan-pinjam.main',compact('title','page'));
	}

	public function tambah()
	{
		$title = 'Form Panduan Pinjam | Admin';
		$page  = 'panduan-pinjam';

		return view('Pengurus.Admin.page.panduan-pinjam.form-panduan-pinjam',compact('title','page'));
	}

	public function edit($id)
	{
		$title = 'Form Panduan Pinjam | Admin';
		$page  = 'panduan-pinjam';
		$row   = PanduanPinjam::where('id_panduan_pinjam',$id)->firstOrFail();

		return view('Pengurus.Admin.page.panduan-pinjam.form-panduan-pinjam',compact('title','page','row'));
	}

	public function save(Request $request)
	{
		$langkah_panduan = $request->langkah_panduan;
		$isi_panduan 	 = $request->isi_panduan;
		$foto_panduan	 = $request->foto_panduan;
        $fileName        = $foto_panduan != '' ?uniqid('_foto_panduan_').$foto_panduan->getClientOriginalName():'-';
        $id 			 = $request->id_panduan_pinjam;

		$data_panduan_pinjam = [
			'langkah_panduan' => $langkah_panduan,
			'isi_panduan'     => $isi_panduan,
			'foto_panduan'    => $fileName
		];

		if ($id == '') {
            if ($foto_panduan != '') {
                Image::make($foto_panduan)->resize(642,350,function($constraint){
                	$constraint->aspectRatio();
                	$constraint->upSize();
                })->save('front-assets/foto_panduan/'.$fileName);
            }
			PanduanPinjam::create($data_panduan_pinjam);
			$message = 'Berhasil Input Data';
		}
		else {
			if ($foto_panduan != '') {
                $foto = PanduanPinjam::where('id_panduan_pinjam',$id)->firstOrFail()->foto_panduan;
                if (file_exists(public_path('front-assets/foto_panduan/'.$foto))) {
                    unlink(public_path('front-assets/foto_panduan/'.$foto));
                }
                Image::make($foto_panduan)->resize(642,350,function($constraint){
                	$constraint->aspectRatio();
                	$constraint->upSize();
                })->save('front-assets/foto_panduan/'.$fileName);
			}
			else {
				unset($data_panduan_pinjam['foto_panduan']);
			}
			PanduanPinjam::where('id_panduan_pinjam',$id)->update($data_panduan_pinjam);
			$message = 'Berhasil Update Data';
		}

		return redirect('/admin/panduan-pinjam')->with('message',$message);
	}

	public function delete($id)
	{
		PanduanPinjam::where('id_panduan_pinjam',$id)
					->delete();

		return redirect('/admin/panduan-pinjam')->with('message','Berhasil Hapus Panduan Pinjam');
	}
}