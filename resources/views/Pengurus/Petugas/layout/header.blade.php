@php
$level = Auth::user()->level==2?'admin':(Auth::user()->level==1?'petugas':'');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>{{$title}}</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('/front-assets/img/title.ico') }}">
  <link rel="stylesheet" href="{{asset('admin-assets/plugins/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/plugins/select2/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/dist/css/adminlte.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/dist/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/plugins/datatables/dataTables.bootstrap4.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user mr-2"></i> {{ Auth::user()->username }}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Profile</span>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/settings-profile') }}" class="dropdown-item">
            <i class="fa fa-cogs mr-2"></i> Ubah Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/logout') }}" class="dropdown-item">
          	Logout
          </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('admin-assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Perpus SMKN 7 SMD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin-assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->level==2?'Administrator':(Auth::user()->level==1?'Petugas':'') }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/'.$level.'/dashboard') }}" class="nav-link @if(isset($page)){{$page=='dashboard'?'active':''}}@endif">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/'.$level.'/buku-tamu') }}" class="nav-link @if(isset($page)){{$page == 'buku-tamu'?'active':''}}@endif">
              <i class="nav-icon fa fa-address-book"></i>
              <p>
                Buku Tamu
              </p>
            </a>
          </li>
          @if(Auth::user()->level==2)
          <li class="nav-item">
          	<a href="{{ url('/admin/tahun-ajaran') }}" class="nav-link @if(isset($page)){{$page=='tahun-ajaran'?'active':''}}@endif">
          		<i class="fa fa-address-book nav-icon"></i>
          		<p>Tahun Ajaran</p>
          	</a>
          </li>
          @endif
          @if(Auth::user()->level==2)
          <li class="nav-item has-treeview {{isset($anggota)?$anggota:''}}">
            <a href="#" class="nav-link {{isset($anggota)?'active':''}}">
              <i class="nav-icon fa fa-users"></i>
              <p>
              	Anggota
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/kelas') }}" class="nav-link @if(isset($page)){{$page=='data-kelas'?'active':''}}@endif">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/data-anggota/siswa') }}" class="nav-link @if(isset($page)){{$page=='data-siswa'?'active':''}}@endif">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Data Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/data-anggota/guru') }}" class="nav-link @if(isset($page)){{$page=='data-guru'?'active':''}}@endif">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Data Guru</p>
                </a>
              </li>
            </ul>
          </li>
          @elseif(Auth::user()->level==1)
          <li class="nav-item">
            <a href="{{ url('/petugas/data-anggota') }}" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Data Anggota</p>
            </a>
          </li>
          @endif
          <li class="nav-item has-treeview {{isset($buku)?$buku:''}}">
            <a href="#" class="nav-link {{isset($buku)?'active':''}}">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Buku
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/'.$level.'/barcode-buku') }}" class="nav-link @if(isset($page)){{$page=='barcode'?'active':''}}@endif">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Barcode Buku</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/'.$level.'/data-buku') }}" class="nav-link @if(isset($page)){{$page=='data-buku'?'active':''}}@endif">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Data Buku</p>
                </a>
              </li>
              @if(Auth::user()->level==2)
              <li class="nav-item">
                <a href="{{ url('/admin/kategori-buku') }}" class="nav-link @if(isset($page)){{$page=='kategori-buku'?'active':''}}@endif">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Kategori Buku</p>
                </a>
              </li>
              @endif
              <li class="nav-item">
              	<a href="{{ url('/'.$level.'/transaksi-buku/siswa') }}" class="nav-link @if(isset($page)){{$page=='transaksi-buku-siswa'?'active':''}}@endif">
              		<i class="fa fa-circle-o nav-icon"></i>
              		<p>Transaksi Buku Siswa</p>
              	</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/'.$level.'/transaksi-buku/guru') }}" class="nav-link @if(isset($page)){{$page=='transaksi-buku-guru'?'active':''}}@endif">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Transaksi Buku Guru</p>
                </a>
              </li>
            </ul>
          </li>
          @if(Auth::user()->level==2)
          <li class="nav-item">
          	<a href="{{ url('/admin/data-petugas') }}" class="nav-link @if(isset($page)){{$page=='data-petugas'?'active':''}}@endif">
          		<i class="fa fa-user-circle nav-icon"></i>
          		<p>Data Petugas</p>
          	</a>
          </li>	
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">