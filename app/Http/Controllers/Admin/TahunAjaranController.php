<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaranModel as TahunAjaran;

class TahunAjaranController extends Controller
{
    public function index() 
    {
        $title = 'Tahun Ajaran | Admin';
        $page = 'tahun-ajaran';
        return view('Pengurus.Admin.page.tahun-ajaran.main',compact('title','page'));
    }

    public function tambah() 
    {
      // dd('lol');
        $title = 'Form Tahun Ajaran | Admin';
        $page = 'tahun-ajaran';
        return view('Pengurus.Admin.page.tahun-ajaran.form-tahun-ajaran',compact('title','page'));
    }

    public function edit($id) 
    {
        $title = 'Form Tahun Ajaran | Admin';
        $page = 'tahun-ajaran';
        $row = TahunAjaran::where('id_tahun_ajaran',$id)->firstOrFail();
        return view('Pengurus.Admin.page.tahun-ajaran.form-tahun-ajaran',compact('title','page','row'));
    }

    public function delete($id) 
    {
        TahunAjaran::where('id_tahun_ajaran',$id)->delete();
        return redirect('/admin/tahun-ajaran')->with('message','Berhasil Hapus Tahun Ajaran');
    }

    public function save(Request $request) 
    {
        $tahun_ajaran = $request->tahun_ajaran;
        if (TahunAjaran::where('tahun_ajaran',$tahun_ajaran)->count() > 0) {
            return redirect('/admin/tahun-ajaran')->with('log','Maaf Data Tahun Ajaran '.$tahun_ajaran.' Sudah Ada');
        }
        $id           = $request->id_tahun_ajaran;
        $array        = ['tahun_ajaran' => $tahun_ajaran];
        if ($id == '') {
            TahunAjaran::create($array);
            $message = 'Berhasil Input Tahun Ajaran';
        } else {
            TahunAjaran::where('id_tahun_ajaran',$id)->update($array);
            $message = 'Berhasil Update Tahun Ajaran';
        }
        return redirect('/admin/tahun-ajaran')->with('message',$message);
    }

    public function statusTahun($id)
    {
      $tahun_ajaran = TahunAjaran::where('id_tahun_ajaran', $id)->firstOrFail();

      if ($tahun_ajaran->status_tahun == 0) {
            $tahun_ajaran->update(['status_tahun' => 1]);
            $message = 'Berhasil Aktifkan';
            TahunAjaran::where('id_tahun_ajaran','!=',$id)->update(['status_tahun' => 0]);
      } else {
            $tahun_ajaran->update(['status_tahun' => 0]);
            $message = 'Berhasil Nonaktifkan';
      }

      return redirect('/admin/tahun-ajaran')->with('message',$message);
    }
}
