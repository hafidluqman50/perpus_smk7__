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
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<style>
		.form-group .select2-container, .form-group .select2-selection {
			width: 100% !important;
		}
	</style>	
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
							<form action="{{ url('/admin/buku-tamu/save') }}" method="POST">
								@csrf
								<div class="card-body">
									@if(session()->has('message'))
									<div class="alert alert-success alert-dismissible">
										{!! session('message') !!} <button class="close" type="button" data-dismiss="alert">X</button>
									</div>
									@endif
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Pin Buku Tamu</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									        
											<div class="alert alert-danger alert-dismissible alert-pin is-hide">
												Pin Salah <button class="close" type="button" data-dismiss="alert">X</button>
											</div>
									      <div class="modal-body">
									      	<input type="text" class="form-control" name="pin_buku_tamu" placeholder="Masukkan Pin Buku Tamu">
									      </div>
									      <div class="modal-footer">
									        <button type="button" id="submit_pin" class="btn btn-primary">Submit</button>
									      </div>
									    </div>
									  </div>
									</div>
									<div class="form-group">
										<button class="btn btn-info" id="btn-input-buku-tamu" type="button" data-toggle="modal" data-target="#exampleModal">Input Buku Tamu Guru/Karyawan</button>
										<button class="btn btn-info is-hide" id="btn-input-buku-tamu-siswa" type="button">Input Buku Tamu Siswa</button>
									</div>
									<div id="input-buku-tamu-siswa">
										<div class="form-group">
											<input type="text" class="form-control" name="nisn" placeholder="Masukkan NISN" required="required">
										</div>
										<div class="form-group">
											<select name="ket_buku_tamu" class="form-control" required="required">
												<option value="" selected="" disabled="">=== Masukkan Keterangan ===</option>
												<option value="Mengunjungi Perpustakaan">Mengunjungi Perpustakaan</option>
												<option value="Meminjam Buku">Meminjam Buku</option>
												<option value="Mengembalikan Buku">Mengembalikan Buku</option>
											</select>
										</div>
									</div>
									<div id="input-buku-tamu" class="is-hide">
										<div class="form-group">
											<select name="anggota" class="form-control select2">
												<option value="" selected="" disabled="">=== Pilih Anggota ===</option>
												@foreach ($anggota as $element)
												<option value="{{$element->id_anggota_perpus}}">{{ $element->nomor_induk.' | '.$element->nama_anggota }}</option>
												@endforeach
											</select>
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
<!-- jQuery -->
<script src="{{asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin-assets/plugins/select2/select2.full.min.js')}}"></script>

<script>
	$(() => {
		$('#submit_pin').click(() => {
			$('#submit_pin').html('Loading...').attr('disabled','disabled')
			let getUrl = window.location.origin+'/ajax/pin-buku-tamu';
			
			let get_pin = $('input[name="pin_buku_tamu"]').val()

			$.ajax({
				url: getUrl,
				type: 'GET',
				data: {pin_buku_tamu: get_pin},
			})
			.done((param) => {
				if (param == 'true') {
					$('.select2').select2()
					$('input[name="pin_buku_tamu"]').val('')
					$('#submit_pin').html('Submit').removeAttr('disabled')
					$('#exampleModal').modal('hide')
					$('#input-buku-tamu').removeClass('is-hide')
					$('#input-buku-tamu-siswa').addClass('is-hide')
					$('#btn-input-buku-tamu-siswa').removeClass('is-hide')
					$('#btn-input-buku-tamu').addClass('is-hide')
					$('#input-buku-tamu-siswa .form-group').find('input,select').removeAttr('required')
					$('#input-buku-tamu .form-group').find('input,select').attr('required','required')
				}
				else {
					$('.alert-pin').removeClass('is-hide');
				}
			})
			.fail((error) => {
				console.log(error);
			})
		})

		$('#btn-input-buku-tamu-siswa').click(() => {
			$('#input-buku-tamu-siswa').removeClass('is-hide')
			$('#input-buku-tamu').addClass('is-hide')
			$('#btn-input-buku-tamu').removeClass('is-hide')
			$('#btn-input-buku-tamu-siswa').addClass('is-hide')
			$('#input-buku-tamu-siswa .form-group').find('input,select').attr('required','required')
			$('#input-buku-tamu .form-group').find('input,select').removeAttr('required')
		})
	})
</script>