<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PetugasModel as Petugas;
use App\Models\User;
use Arr;

class PetugasController extends Controller
{
    public function index() 
    {
        $title = 'Data Petugas | Admin';
        $page = 'data-petugas';
        return view('Pengurus.Admin.page.data-petugas.main',compact('title','page'));
    }

    public function tambah() 
    {
        $title = 'Form Petugas | Admin';
        $page  = 'data-petugas';

        return view('Pengurus.Admin.page.data-petugas.form-petugas',compact('title','page'));
    }

    public function edit($id) 
    {
        $title = 'Form Petugas | Admin';
        $page  = 'data-petugas';
        $row   = Petugas::join('users','petugas.id_users','=','users.id_users')->where('id_petugas',$id)->firstOrFail();

        return view('Pengurus.Admin.page.data-petugas.form-petugas',compact('title','page','row'));
    }

    public function save(Request $request) 
    {
        $nama_petugas = $request->nama_petugas;
        $nip          = $request->nip;
        $jabatan      = $request->jabatan;
        $username     = $request->username;
        $password     = $request->password;
        $id           = $request->id_petugas;

        $array = [
            'nip'           => $nip,
            'nama_petugas'  => $nama_petugas,
            'jabatan'       => $jabatan,
            'foto_profile'  => '-',
            'username'      => $username,
            'password'      => bcrypt($password),
            'name'          => $nama_petugas,
            'status_akun'   => 1,
            'status_delete' => 0,
            'level'         => 1,
        ];
        //
        if ($username != '' && User::where('username',$username)->count() > 0) {
            return redirect()->back()->withErrors(['errors'=>'Maaf Username Sudah Terdaftar'])->withInput($request->except('password'));
        }
        //
        if ($id == '') {

            $last_id = User::insertGetId(array_slice($array,4));
            $anggota = Arr::except(array_merge($array,['id_users'=>$last_id]),['username','password','level','status_akun','status_delete']);

            Petugas::create($anggota);
            
            $message = 'Berhasil Input Petugas';
        } else {
            $get = Petugas::where('id_anggota',$id);
            $first = $get->firstOrFail();
            
            if ($username != '' && $password != '') {
                User::where('id_users',$first->id_users)->update(array_slice($array,4,-3));
            }
            elseif ($username != '') {
                unset($array['password']);
                User::where('id_users',$first->id_users)->update(array_slice($array,4,-3));
            }
            elseif ($password != '') {
                User::where('id_users',$first->id_users)->update(array_slice($array,5,-3));
            }

            $get->update(array_slice($array,0,-6));
            $message = 'Berhasil Update Petugas';
        }

        return redirect('/admin/data-petugas/')->with('message',$message);
    }

    public function statusPetugas($id) 
    {
        $petugas = Petugas::where('id_petugas',$id)->firstOrFail();
        $users   = User::where('id_users',$petugas->id_users);
        if ($users->firstOrFail()->status_akun == 0) {
            $users->update(['status_akun'=>1]);
            $message = 'Berhasil Aktifkan';
        } else {
            $users->update(['status_akun'=>0]);
            $message = 'Berhasil Nonaktifkan';
        }
        return redirect('/admin/data-petugas/')->with('message',$message);
    }
}
