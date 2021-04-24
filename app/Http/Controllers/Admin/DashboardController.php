<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    public function dashboard() 
    {
        $title = 'Dashboard | Admin';
        $page  = 'dashboard';

    	return view('Pengurus.Admin.page.dashboard',compact('title','page'));
    }

    public function ubahProfile() 
    {
        $title = 'Ubah Profile | Admin';
        $page  = '';

        return view('Pengurus.Admin.page.ubah-profile',compact('title','page'));
    }

    public function save(Request $request)
    {
        $nama     = $request->nama;
        $username = $request->username;
        $password = $request->password;

        if (User::checkUsername($username) == false) {
            return redirect('/admin/settings-profile')->withInput($request->input());
        }

        $data_users = ['name' => $nama,'username' => $username,'password' => bcrypt($password)];

        if ($username == '' && $password != '') {
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
        else {
            unset($data_users['username']);
            unset($data_users['password']);
            User::where('id_users',Auth::id())
                ->update($data_users);

            $message = 'Berhasil Ubah Nama';
        }

        return redirect('/admin/ubah-profile')->with('message',$message);
    }
}
