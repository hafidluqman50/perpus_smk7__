@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Karyawan</h1>
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
						<a href="{{url('/admin/data-anggota/guru')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/data-anggota/save')}}" method="POST">
						@csrf
						@if($errors->any())
							<div class="alert alert-danger alert-dismissible">{{$errors->all()[0]}} <button class="close">X</button></div>
						@endif
						<div class="card-body">
							<div class="form-group">
								<label for="" class="form-label">Nomor Induk Karyawan</label>
								<input type="number" class="form-control" name="nomor_induk" value="{{isset($row)?$row->nomor_induk:(isset($errors)?old('nomor_induk'):'')}}" placeholder="Isi Nomor Induk Karyawan">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Nama Karyawan</label>
								<input type="text" class="form-control" name="nama_anggota" value="{{isset($row)?$row->nama_anggota:(isset($errors)?old('nama_anggota'):'')}}" placeholder="Isi Nama Karyawan" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Email Karyawan</label>
								<input type="email" class="form-control" name="email" value="{{isset($row)?$row->email:(isset($errors)?old('email'):'')}}" placeholder="Isi Email Karyawan" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Nomor HP</label>
								<input type="number" class="form-control" name="no_hp" value="{{isset($row)?$row->nmr_hp:(isset($errors)?old('no_hp'):'')}}" placeholder="Isi Nomor Hp" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Jenis Kelamin</label>
								<select name="jenis_kelamin" class="form-control" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Jenis Kelamin ===</option>
									<option value="Laki-Laki"@if(isset($row)){!!$row->jenis_kelamin=='Laki-Laki'?'selected="selected"':''!!}@elseif(isset($errors)){!!old('jenis_kelamin')=='Laki-Laki' ? 'selected="selected"' : ''!!}@endif>Laki-Laki</option>
									<option value="Perempuan"@if(isset($row)){!!$row->jenis_kelamin=='Perempuan'?'selected="selected"':''!!}@elseif(isset($errors)){!!old('jenis_kelamin')=='Perempuan' ? 'selected="selected"' : ''!!}@endif>Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Username Karyawan</label>
								<input type="text" class="form-control" name="username" value="{!!isset($row)?$row->username:(isset($errors)?old('username'):'')!!}" placeholder="Isi Username" {!!isset($row)?'disabled="disabled"':'required="required"'!!}>
								{!!isset($row)?'<input type="checkbox" id="check"> Ubah Username':''!!}
							</div>
							<div class="form-group">
								<label for="" class="form-label">Password Karyawan</label>
								<input type="password" class="form-control" name="password" placeholder="Isi Password" {!!isset($row)?'':'required="required"'!!}>
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="tipe" value="karyawan">
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