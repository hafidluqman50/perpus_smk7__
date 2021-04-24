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
use Image;
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
        $username     = $request->username;
        $email        = $request->email;
        $password     = $request->password;
        $id           = $request->id_users;
        $foto_profile = $request->foto_profile;
        $fileName     = $foto_profile != '' ?uniqid('_photo_profile_').$foto_profile->getClientOriginalName():'-';

        $anggota = [
            'email' => $email,
        ];

        $data_users = ['username' => $username,'password' => bcrypt($password)];

        if ($foto_profile != '' || $foto_profile != null) {
            $foto = Anggota::where('id_anggota',$id)->firstOrFail()->foto_profile;
            
            if (file_exists(public_path('front-assets/profile_anggota/'.$foto))) {
                unlink(public_path('front-assets/profile_anggota/'.$foto));
            }

            Image::make($foto_profile)->resize(446,446,function($constraint){
                $constraint->aspectRatio();
                $constraint->upSize();
            })->save('front-assets/profile_anggota/'.$fileName);

            $anggota['foto_profile'] = $fileName;
        }

        if ($username == '' && $password != '') {
            if (User::checkUsername($username) == false) {
                return redirect('/ubah/profile')->withInput($request->input());
            }
            unset($data_users['username']);
            User::where('id_users',Auth::id())
                ->update($data_users);

            $message = 'Berhasil Ubah Password';
        }
        else if($username != '' && $password == '') {
            unset($data_users['password']);
            User::where('id_users',Auth::id())
                ->update($data_users);  

            $message = 'Berhasil Ubah Username';
        }
        else if ($username != '' && $password != '') {
            User::where('id_users',Auth::id())
                ->update($data_users);

            $message = 'Berhasil Ubah Username & Password';
        }

        Anggota::where('id_users',$id)->update($anggota);

        return redirect('/profile')->with('success','Berhasil Update Profile');
    }
}
