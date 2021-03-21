@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Siswa</h1>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<a href="{{url('/admin/data-anggota/siswa')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/data-anggota/save')}}" method="POST">
						@csrf
						<div class="card-body">
							@if($errors->any())
								<div class="alert alert-danger alert-dismissible">{{$errors->all()[0]}} <button class="close">X</button></div>
							@endif
							<div class="form-group">
								<label for="" class="form-label">Nomor Induk Siswa</label>
								<input type="number" name="nomor_induk" class="form-control" value="{{isset($row)?$row->nomor_induk:(isset($errors)?old('nomor_induk'):'')}}" placeholder="Isi Nomor Induk Siswa" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Nama Siswa</label>
								<input type="text" class="form-control" name="nama_anggota" value="{{isset($row)?$row->nama_anggota:(isset($errors)?old('nama_anggota'):'')}}" placeholder="Isi Nama Lengkap Siswa" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Email Siswa</label>
								<input type="email" class="form-control" name="email" value="{{isset($row)?$row->email:(isset($errors)?old('email'):'')}}" placeholder="Isi Email" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Nomor HP</label>
								<input type="number" class="form-control" name="no_hp" value="{{isset($row)?$row->nmr_hp:(isset($errors)?old('no_hp'):'')}}" placeholder="Isi Nomor HP" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Jenis Kelamin</label>
								<select name="jenis_kelamin" class="form-control" id="" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Jenis Kelamin ===</option>
									<option value="Laki-Laki"@if(isset($row)){!!$row->jenis_kelamin=='Laki-Laki'?'selected="selected"':''!!}@elseif(isset($errors)){!!old('jenis_kelamin')=='Laki-Laki' ? 'selected="selected"' : ''!!}@endif>Laki-Laki</option>
									<option value="Perempuan"@if(isset($row)){!!$row->jenis_kelamin=='Perempuan'?'selected="selected"':''!!}@elseif(isset($errors)){!!old('jenis_kelamin')=='Perempuan' ? 'selected="selected"' : ''!!}@endif>Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Username Siswa</label>
								<input type="text" class="form-control" name="username" value="{!!isset($row)?$row->username:(isset($errors)?old('username'):'')!!}" placeholder="Isi Username" {!!isset($row)?'disabled="disabled"':'required="required"'!!}>
								{!!isset($row)?'<input type="checkbox" id="check"> Ubah Username':''!!}
							</div>
							<div class="form-group">
								<label for="" class="form-label">Password Siswa</label>
								<input type="password" class="form-control" name="password" placeholder="Isi Password" {!!isset($row)?'':'required="required"'!!}>
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="tipe" value="siswa">
							<input type="hidden" name="id_anggota" value="{{isset($row)?$row->id_anggota:''}}">
							<button type="submit" class="btn btn-primary">
								Simpan <span class="fa fa-save"></span>
							</button>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection