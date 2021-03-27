<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>{{$title}}</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('/front-assets/img/title.ico') }}">
  	<link rel="stylesheet" href="{{asset('admin-assets/plugins/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/dist/css/adminlte.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin-assets/dist/css/custom.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body style="background-image: url('/admin-assets/dist/img/smk7-gambar.jpeg');">
	{{-- <div class="content-wrapper"> --}}
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card" style="margin-top:15%; margin-left:10%; margin-right:10%;">
							<div class="card-header">
								<h5 align="center">Buku Tamu</h5>
							</div>
							<form action="{{ url('/petugas/buku-tamu/save') }}" method="POST">
								@csrf
								<div class="card-body">
									@if(session()->has('message'))
									<div class="alert alert-success alert-dismissible">
										{!! session('message') !!} <button class="close" type="button" data-dismiss="alert">X</button>
									</div>
									@endif
									<div class="form-group">
										<button class="btn btn-info" type="button">Buku Tamu Guru</button>
										<button class="btn btn-info" type="button">Buku Tamu Siswa</button>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="nisn" placeholder="Masukkan NISN">
									</div>
									<div class="form-group">
										<select name="ket_buku_tamu" class="form-control">
											<option value="" selected="" disabled="">=== Masukkan Keterangan ===</option>
											<option value="Mengunjungi Perpustakaan">Mengunjungi Perpustakaan</option>
											<option value="Meminjam Buku">Meminjam Buku</option>
											<option value="Mengembalikan Buku">Mengembalikan Buku</option>
										</select>
									</div>
								</div>
								<div class="card-footer">
									<button class="btn btn-primary">
										Submit
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	{{-- </div> --}}
</body>
</html>