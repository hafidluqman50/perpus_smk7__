<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PetugasModel as Petugas;
use App\Models\User;
use Arr;
use Intervention\Image\ImageManagerStatic as Image;

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
        $foto_petugas = $request->foto_petugas;
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
            if ($foto_petugas != '' || $foto_petugas != null) {
                $fileName = uniqid('_foto_petugas_').$foto_petugas->getClientOriginalName();

                Image::make($foto_petugas)->resize(642,350,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upSize();
                })->save('front-assets/foto_petugas/'.$fileName);

                $array['foto_profile'] = $fileName;
            }
            $last_id = User::insertGetId(array_slice($array,4));
            $anggota = Arr::except(array_merge($array,['id_users'=>$last_id]),['username','name','password','level','status_akun','status_delete']);

            Petugas::create($anggota);
            
            $message = 'Berhasil Input Petugas';
        } else {
            $get = Petugas::where('id_petugas',$id);
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

            if ($foto_petugas != '') {
                $foto = Petugas::where('id_petugas',$id)->firstOrFail()->foto_petugas;
                
                if (file_exists(public_path('front-assets/foto_petugas/'.$foto))) {
                    unlink(public_path('front-assets/foto_petugas/'.$foto));
                }
                
                $fileName = uniqid('_foto_petugas_').$foto_petugas->getClientOriginalName();

                Image::make($foto_petugas)->resize(446,446,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upSize();
                })->save('front-assets/foto_petugas/'.$fileName);

                unset($array['username'],
                      $array['password'],
                      $array['name'],
                      $array['status_akun'],
                      $array['status_delete'],
                      $array['level']);

                Petugas::where('id_petugas',$id)->update($array);
            }

            $get->update(array_slice($array,0,-6));
            $message = 'Berhasil Update Petugas';
        }

        return redirect('/admin/data-petugas/')->with('message',$message);
    }

    public function delete($id)
    {
        $get = Petugas::where('id_petugas',$id);
        $foto = $get->firstOrFail()->foto_profile;
        if (file_exists(public_path('front-assets/foto_petugas/'.$foto))) {
            unlink(public_path('front-assets/foto_petugas/'.$foto));
        }
        User::where('id_users',$get->firstOrFail()->id_users)->update(['status_delete'=>1]);
        $get->delete();


        return redirect('/admin/data-petugas');
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
