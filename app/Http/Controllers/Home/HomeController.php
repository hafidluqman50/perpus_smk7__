<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AnggotaModel as Anggota;
use App\Models\AnggotaPerpusModel as AnggotaPerpus;
use App\Models\BukuModel as Buku;
use App\Models\TransaksiDetailModel as TransaksiDetail;
use App\Models\RatingModel as Rating;
use App\Models\PanduanPinjamModel as PanduanPinjam;
use App\Models\PetugasModel as Petugas;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    public function home() 
    {
        $title          = 'Home';
        $buku           = new Buku;
        $panduan_pinjam = PanduanPinjam::all();
        $petugas        = Petugas::all();

        if (Auth::check() && Auth::user()->status_akun == 1) {
            $anggota      = AnggotaPerpus::getRow(Auth::user()->id_users);
            $nama_anggota = explode_nama($anggota->nama_anggota);
            $cek          = TransaksiDetail::cekTransaksi($anggota->id_anggota);
            $compact      = compact('anggota','nama_anggota','title','buku','cek','panduan_pinjam','petugas');
    	}
        else {
            Auth::check() ? Auth::logout() : '';
            $compact = compact('title','buku','panduan_pinjam','petugas');
        }
        return view('Main.page.main-page',$compact);
    }

    public function profile() 
    {
        $title   = 'Profile';
        $anggota = AnggotaPerpus::getRow(Auth::id());
        $cek     = TransaksiDetail::getTransaksiByAnggota($anggota->id_anggota);
        return view('Main.page.profile',compact('title','anggota','cek'));
    }

    public function settings() 
    {
        $title   = 'Ubah Profile';
        $anggota = AnggotaPerpus::getRow(Auth::id());
        return view('Main.page.ubah-profile',compact('title','anggota'));
    }

    public function saveSettings(Request $request) 
    {
        $username = $request->username;
        $email    = $request->email;
        $password = $request->password;
        $id       = $request->id_users;

        $anggota = [
            'email' => $email,
        ];
        $user = [
            'username' => $username,
            'password' => bcrypt($password)
        ];

        Anggota::where('id_users',$id)->update($anggota);
        User::where('id_users',$id)->update($user);

        return redirect('/profile')->with('success','Berhasil Update Profile');
    }
}
