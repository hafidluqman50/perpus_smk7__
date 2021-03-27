<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    public function dashboard() 
    {
    	$title = 'Dashboard | Petugas';
    	$page = 'dashboard';
    	return view('Pengurus.Petugas.page.dashboard',compact('title','page'));
    }

    public function settingProfile() 
    {
    	
    }
}
