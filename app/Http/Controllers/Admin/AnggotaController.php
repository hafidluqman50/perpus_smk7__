<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AnggotaModel as Anggota;
use App\Models\AnggotaPerpusModel as AnggotaPerpus;
use App\Models\User;
use Str;

class AnggotaController extends Controller
{
    public function siswa() 
    {
        $title   = 'Data Siswa | Admin';
        $anggota = 'menu-open';
        $page    = 'data-siswa';
        return view('Pengurus.Admin.page.anggota.data-siswa.main',compact('title','anggota','page'));
    }

    public function tambahSiswa() 
    {
        $title        = 'Form Siswa | Admin';
        $anggota      = 'menu-open';
        $page         = 'data-siswa';
        return view('Pengurus.Admin.page.anggota.data-siswa.form-siswa',compact('title','anggota','page'));
    }

    public function editSiswa($id) 
    {
        $title        = 'Form Siswa | Admin';
        $page         = 'data-siswa';
        $row          = Anggota::getData($id);
        return view('Pengurus.Admin.page.anggota.data-siswa.form-siswa',compact('title','page','row'));
    }

    public function guru() 
    {
        $title   = 'Data Guru | Admin';
        $anggota = 'menu-open';
        $page    = 'data-guru';
        return view('Pengurus.Admin.page.anggota.data-guru.main',compact('title','anggota','page'));
    }

    public function tambahGuru() 
    {
        $title   = 'Form Guru | Admin';
        $anggota = 'menu-open';
        $page    = 'data-guru';
        return view('Pengurus.Admin.page.anggota.data-guru.form-guru',compact('title','anggota','page'));
    }

    public function editGuru($id) 
    {
        $title = 'Form Guru | Admin';
        $page  = 'data-guru';
        $row   = Anggota::getData($id);
        return view('Pengurus.Admin.page.anggota.data-guru.form-guru',compact('title','page','row'));
    }

    public function deleteAnggota($id) 
    {
        $get   = Anggota::where('id_anggota',$id);
        $first = $get->firstOrFail();
        if (file_exists(public_path('front-assets/foto_anggota/'.$first->foto_profile))) {
            unlink(public_path('front-assets/foto_anggota/'.$first->foto_profile));
        }
        $tipe = TipeAnggota::where('id_tipe_anggota',$first->id_tipe_anggota)->firstOrFail()->tipe_anggota;
        $user = User::where('id_users',$first->id_users)->delete();
        $get->delete();
        return redirect('/admin/data-anggota/'.$tipe)->with('message','Berhasil Hapus '.ucwords($tipe));
    }

    public function statusAnggota($id) 
    {
        $anggota = Anggota::where('id_anggota',$id)->firstOrFail();
        $tipe    = Anggota::where('id_anggota',$anggota->id_anggota)->firstOrFail()->tipe_anggota;
        $users   = User::where('id_users',$anggota->id_users);
        if ($users->firstOrFail()->status_akun == 0) {
            $users->update(['status_akun'=>1]);
            $message = 'Berhasil Aktifkan';
        } else {
            $users->update(['status_akun'=>0]);
            $message = 'Berhasil Nonaktifkan';
        }
        return redirect('/admin/data-anggota/'.$tipe)->with('message',$message.' '.ucwords($tipe));
    }

    public function saveAnggota(Request $request) 
    {
        $nama_anggota  = $request->nama_anggota;
        $nomor_induk   = $request->nomor_induk;
        $email         = $request->email;
        $no_hp         = $request->no_hp;
        $jenis_kelamin = $request->jenis_kelamin;
        $username      = $request->username;
        $password      = $request->password;
        $tipe          = $request->tipe;
        $id            = $request->id_anggota;

        $array = [
            'nomor_induk'     => $nomor_induk,
            'nama_anggota'    => $nama_anggota,
            'nama_slug'       => Str::slug($nama_anggota,'-'),
            'email'           => $email,
            'nmr_hp'          => $no_hp,
            'jenis_kelamin'   => $jenis_kelamin,
            'foto_profile'    => '-',
            'tipe_anggota'    => $tipe,
            'username'        => $username,
            'password'        => bcrypt($password),
            'status_akun'     => 1,
            'status_delete'   => 0,
            'level'           => 0,
        ];
        //
        if ($username != '' && User::where('username',$username)->count() > 0) {
            return redirect()->back()->withErrors(['errors'=>'Maaf Username Sudah Terdaftar'])->withInput($request->except('password'));
        }
        //
        if ($id == '') {

            $last_id = User::insertGetId(array_slice($array,8));
            $anggota = array_except(array_merge($array,['id_users'=>$last_id]),['username','password','level','status_akun','status_delete']);

            Anggota::create($anggota);

            if ($tipe == 'guru') {
                $get_id_anggota = Anggota::where('id_users',$last_id)->firstOrFail()->id_anggota;
                AnggotaPerpus::create(['id_anggota' => $get_id_anggota,'id_kelas'=>1,'id_tahun_ajaran'=>1]);
            }
            
            $message = 'Berhasil Input '.ucwords($tipe);
        } else {
            $get = Anggota::where('id_anggota',$id);
            $first = $get->firstOrFail();
            
            if ($username != '' && $password != '') {
                User::where('id_users',$first->id_users)->update(array_slice($array,8,-3));
            }
            elseif ($username != '') {
                User::where('id_users',$first->id_users)->update(array_slice($array,8,-4));
            }
            elseif ($password != '') {
                User::where('id_users',$first->id_users)->update(array_slice($array,9,-3));
            }

            $get->update(array_slice($array,0,-5));
            $message = 'Berhasil Update '.ucwords($tipe);
        }

        return redirect('/admin/data-anggota/'.$tipe)->with('message',$message);
    }
}