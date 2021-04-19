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
						<a href="{{url('/admin/data-petugas')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/data-petugas/save')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="card-body">
							@if($errors->any())
								<div class="alert alert-danger alert-dismissible">{{$errors->all()[0]}} <button class="close">X</button></div>
							@endif
							<div class="form-group">
								<label for="" class="form-label">NIP</label>
								<input type="text" name="nip" class="form-control" value="{{isset($row)?$row->nip:(isset($errors)?old('nip'):'')}}" placeholder="Isi NIP" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Nama Petugas</label>
								<input type="text" class="form-control" name="nama_petugas" value="{{isset($row)?$row->nama_petugas:(isset($errors)?old('nama_petugas'):'')}}" placeholder="Isi Nama Lengkap" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Jabatan</label>
								<select name="jabatan" class="form-control" id="" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Jabatan ===</option>
									<option value="kepala-perpustakaan"@if(isset($row)){!!$row->jabatan=='kepala-perpustakaan'?'selected="selected"':''!!}@elseif(isset($errors)){!!old('jabatan')=='kepala-perpustakaan' ? 'selected="selected"' : ''!!}@endif>Kepala Perpustakaan</option>
									<option value="pustakawan"@if(isset($row)){!!$row->jabatan=='pustakawan'?'selected="selected"':''!!}@elseif(isset($errors)){!!old('jabatan')=='pustakawan' ? 'selected="selected"' : ''!!}@endif>Pustakawan</option>
								</select>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Username Petugas</label>
								<input type="text" class="form-control" name="username" value="{!!isset($row)?$row->username:(isset($errors)?old('username'):'')!!}" placeholder="Isi Username" {!!isset($row)?'disabled="disabled"':'required="required"'!!}>
								{!!isset($row)?'<input type="checkbox" id="check"> Ubah Username':''!!}
							</div>
							<div class="form-group">
								<label for="" class="form-label">Password Petugas</label>
								<input type="password" class="form-control" name="password" placeholder="Isi Password" {!!isset($row)?'':'required="required"'!!}>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Foto Petugas</label>
								<input type="file" name="foto_petugas" class="form-control">
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="id_petugas" value="{{isset($row)?$row->id_petugas:''}}">
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