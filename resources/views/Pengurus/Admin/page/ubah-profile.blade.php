@extends('Pengurus.Admin.layout.layout-app')

@section('content')
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Ubah Profile</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					@if(session()->has('message'))
					<div class="alert alert-success alert-dismissible fade show">
						{{ session('message') }} <button class="close" data-dismiss="alert">X</button>
					</div>
					@elseif(old('username') != '')
					<div class="alert alert-danger alert-dismissible fade show">
						Username Sudah Digunakan <button class="close" data-dismiss="alert">X</button>
					</div>
					@endif
					<form action="{{ url('/admin/ubah-profile/save') }}" method="POST" enctype="multipart/form-data" oninput="re_type_password.setCustomValidity(re_type_password.value != password.value ? 'Passwords do not match.' : '')">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" name="nama" class="form-control" value="{{ old('nama') != '' ? old('nama') : Auth::user()->name }}">
							</div>
							<div class="form-group">
								<label for="">Username</label>
								<input type="text" name="username" class="form-control" value="{{ old('username') != '' ? old('username') : Auth::user()->username }}" disabled="disabled">
								<input type="checkbox" id="sip"> Ubah Username
							</div>
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="form-group">
								<label for="">Re-type Password</label>
								<input type="password" name="re_type_password" class="form-control">
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary">Simpan <span class="fa fa-save"></span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('js')
<script>
	$(function(){
		$('#sip').click(function(){
			if ($(this).is(':checked')) {
				$('input[name="username"]').removeAttr('disabled');
			}
			else {
				$('input[name="username"]').attr('disabled','disabled');
			}
		});
	});
</script>
@endsection