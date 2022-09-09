<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AnggotaModel as Anggota;
use App\Models\AnggotaPerpusModel as AnggotaPerpus;
use App\Models\User;
use Arr;
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
        $title   = 'Form Siswa | Admin';
        $anggota = 'menu-open';
        $page    = 'data-siswa';
        $row     = Anggota::getData($id);
        return view('Pengurus.Admin.page.anggota.data-siswa.form-siswa',compact('title','page','row','anggota'));
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
        $title   = 'Form Guru | Admin';
        $anggota = 'menu-open';
        $page    = 'data-guru';
        $row     = Anggota::getData($id);
        return view('Pengurus.Admin.page.anggota.data-guru.form-guru',compact('title','page','row','anggota'));
    }

    public function karyawan() 
    {
        $title   = 'Data Karyawan | Admin';
        $anggota = 'menu-open';
        $page    = 'data-karyawan';
        return view('Pengurus.Admin.page.anggota.data-karyawan.main',compact('title','anggota','page'));
    }

    public function tambahKaryawan() 
    {
        $title   = 'Form Karyawan | Admin';
        $anggota = 'menu-open';
        $page    = 'data-karyawan';
        return view('Pengurus.Admin.page.anggota.data-karyawan.form-karyawan',compact('title','anggota','page'));
    }

    public function editKaryawan($id) 
    {
        $title   = 'Form Karyawan | Admin';
        $page    = 'data-karyawan';
        $anggota = 'menu-open';
        $row     = Anggota::getData($id);
        return view('Pengurus.Admin.page.anggota.data-karyawan.form-karyawan',compact('title','page','row','anggota'));
    }

    public function deleteAnggota($id) 
    {
        $get   = Anggota::where('id_anggota',$id);
        $first = $get->firstOrFail();
        if (file_exists(public_path('front-assets/foto_anggota/'.$first->foto_profile))) {
            unlink(public_path('front-assets/foto_anggota/'.$first->foto_profile));
        }
        $user = User::where('id_users',$first->id_users)->update(['status_delete' => 1]);
        $get->update(['status_delete' => 1]);
        return redirect('/admin/data-anggota/'.$first->tipe_anggota)->with('message','Berhasil Hapus '.ucwords($first->tipe_anggota));
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
        $nomor_induk   = $request->nomor_induk ?? '-';
        $email         = $request->email;
        $no_hp         = $request->no_hp;
        $jenis_kelamin = $request->jenis_kelamin;
        $username      = $request->username;
        $password      = $request->password;
        $tipe          = $request->tipe;
        $id            = $request->id_anggota;

        $data_anggota = [
            'nomor_induk'     => $nomor_induk,
            'nama_anggota'    => $nama_anggota,
            'nama_slug'       => Str::slug($nama_anggota,'-'),
            'email'           => $email,
            'nmr_hp'          => $no_hp,
            'jenis_kelamin'   => $jenis_kelamin,
            'foto_profile'    => '-',
            'tipe_anggota'    => $tipe,
            'status_delete'   => 0,
        ];

        $data_user = [
            'username'        => $username,
            'password'        => bcrypt($password),
            'name'            => $nama_anggota,
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

            $last_id = User::insertGetId($data_user);
            // $anggota = Arr::except(array_merge($array,['id_users'=>$last_id]),['username','name','password','level','status_akun','status_delete']);

            $data_anggota['id_users'] = $last_id;

            Anggota::create($data_anggota);

            if ($tipe == 'guru' || $tipe == 'karyawan') {
                $get_id_anggota = Anggota::where('id_users',$last_id)->firstOrFail()->id_anggota;
                AnggotaPerpus::create(['id_anggota' => $get_id_anggota,'id_kelas'=>1,'id_tahun_ajaran'=>1]);
            }
            
            $message = 'Berhasil Input '.ucwords($tipe);
        } else {
            $get = Anggota::where('id_anggota',$id);
            $first = $get->firstOrFail();
            
            if ($username != '' && $password != '') {
                unset($data_user['level'],$data_user['status_akun'],$data_user['status_delete']);
                User::where('id_users',$first->id_users)->update($data_user);
            }
            elseif ($username != '') {
                unset($data_user['password'],$data_user['level'],$data_user['status_akun'],$data_user['status_delete']);
                User::where('id_users',$first->id_users)->update($data_user);
            }
            elseif ($password != '') {
                unset($data_user['username'],$data_user['level'],$data_user['status_akun'],$data_user['status_delete']);
                User::where('id_users',$first->id_users)->update($data_user);
            }

            unset($data_anggota['status_delete']);
            $get->update($data_anggota);
            $message = 'Berhasil Update '.ucwords($tipe);
        }

        return redirect('/admin/data-anggota/'.$tipe)->with('message',$message);
    }
}
