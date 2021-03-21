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
    	$page = 'dashboard';
    	return view('Pengurus.Admin.page.dashboard',compact('title','page'));
    }

    public function settingProfile() 
    {
    	
    }
}
