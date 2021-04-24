<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PetugasModel as Petugas;
use Image;
use Auth;

class DashboardController extends Controller
{
    public function dashboard() 
    {
        $title = 'Dashboard | Petugas';
        $page  = 'dashboard';

    	return view('Pengurus.Petugas.page.dashboard',compact('title','page'));
    }

    public function ubahProfile() 
    {
        $title = 'Ubah Profile | Petugas';
        $page  = '';

        return view('Pengurus.Petugas.page.ubah-profile',compact('title','page'));
    }

    public function save(Request $request)
    {
        $nama         = $request->nama;
        $username     = $request->username;
        $password     = $request->password;
        $foto_profile = $request->foto_profile;
        $fileName     = $foto_profile != '' ?uniqid('_foto_petugas_').$foto_profile->getClientOriginalName():'-';

        if (User::checkUsername($username) == false) {
            return redirect('/petugas/settings-profile')->withInput($request->input());
        }

        $data_petugas = ['nama_petugas' => $nama];

        $data_users   = ['name' => $nama,'username' => $username,'password' => bcrypt($password)];

        if ($foto_profile != '' || $foto_profile != null) {
            $foto = Petugas::where('id_users',Auth::id())->firstOrFail()->foto_profile;
            
            if (file_exists(public_path('front-assets/foto_petugas/'.$foto))) {
                unlink(public_path('front-assets/foto_petugas/'.$foto));
            }

            Image::make($foto_profile)->resize(446,446,function($constraint){
                $constraint->aspectRatio();
                $constraint->upSize();
            })->save('front-assets/foto_petugas/'.$fileName);

            $data_petugas['foto_profile'] = $fileName;
        }

        if ($username == '' && $password != '') {
            unset($data_users['username']);
            User::where('id_users',Auth::id())
                ->update($data_users);
        }
        else if($username != '' && $password == '') {
            unset($data_users['password']);
            User::where('id_users',Auth::id())
                ->update($data_users);  
        }
        else if ($username != '' && $password != '') {
            User::where('id_users',Auth::id())
                ->update($data_users);
        }
        else {
            unset($data_users['username']);
            unset($data_users['password']);
            User::where('id_users',Auth::id())
                ->update($data_users);
        }

        Petugas::where('id_users',Auth::id())->update($data_petugas);

        return redirect('/petugas/ubah-profile')->with('message','Berhasil Ubah Profile');
    }
}
