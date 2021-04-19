<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Artisan;
use Arr;

class AuthController extends Controller
{
    public function FormLogin() {
        $title = 'Form Login';
        return view('Main.page.login',compact('title'));
    }

    public function login(Request $request){
    	$username = $request->username;
    	$password = $request->password;
    	if (Auth::attempt(['username' => $username, 'password' => $password, 'status_delete' => 0])) {
            if (Auth::user()->level==0 && Auth::user()->status_akun == 1) {
                // dd(Auth::check());
    			return redirect()->intended('/');
            }
            else if (Auth::user()->level==1 && Auth::user()->status_akun == 1) {
                return redirect()->intended('/petugas/dashboard');
            }
            else if (Auth::user()->level==2 && Auth::user()->status_akun == 1) {
                return redirect()->intended('/admin/dashboard');
            }
            else if(Auth::user()->status_akun==0) {
            	Auth::logout();
            	return redirect('/login-form')->with('fail','Maaf Akun Anda Tidak Aktif');
            }
    	}
    	else {
    		$error = Arr::except($request->all(),['password']);
    		\Log::critical('Login gagal',$error);
            $data = 'User Atau Pass Salah';
            return redirect('/login-form')->with('fail',$data);
    	}
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
