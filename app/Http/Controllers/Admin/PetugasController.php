<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

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

    }

    public function edit($id) {

    }

    public function save(Request $request) {
        
    }
}
