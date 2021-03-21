@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Kategori</h1>
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
						<a href="{{url('/admin/kategori-buku')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/kategori/save')}}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="" class="form-label">Nama Kategori</label>
								<input type="text" name="nama_kategori" class="form-control" value="{{isset($row)?$row->nama_kategori:''}}" required="required" placeholder="Isi Nama Kategori">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Deskripsi Kategori</label>
								<textarea name="deskripsi_kategori" class="form-control" id="" cols="30" rows="10" placeholder="Isi Deskripsi Kategori" required="required">{{isset($row)?$row->deskripsi_kategori:''}}</textarea>
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="id_kategori_buku" value="{{isset($row)?$row->id_kategori_buku:''}}">
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
