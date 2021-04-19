@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<div class="content-header">
	<div class="row">
		<div class="col-md-12">
			<h1 class="m-0 text-dark">Form Panduan Pinjam</h1>
		</div>
	</div>
</div>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<a href="{{url('/admin/panduan-pinjam')}}">
						<button class="btn btn-default">
							<span class="fa fa-long-arrow-left"></span> Kembali
						</button>
					</a>
				</div>
				<form action="{{url('/admin/panduan-pinjam/save')}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">Langkah Panduan</label>
							<input type="text" name="langkah_panduan" class="form-control" value="{{isset($row)?$row->langkah_panduan:''}}" placeholder="Isi Langkah Panduan" required="required">
						</div>
						<div class="form-group">
							<label class="form-label">Isi Panduan</label>
							<textarea name="isi_panduan" class="form-control" cols="30" rows="10" required="required" placeholder="Isi Panduan Pinjam">{{isset($row) ? $row->isi_panduan : ''}}</textarea>
						</div>
						<div class="form-group">
							<label for="">Foto Panduan</label>
							<input type="file" name="foto_panduan" class="form-control" id="image" required="">
							<img class="img-responsive img-thumbnail" {!!isset($row) ? 'src="'.asset("front-assets/foto_panduan/$row->foto_panduan").'"' : ''!!} id="uploadPreview">
						</div>
					</div>
					<div class="card-footer">
						<input type="hidden" name="id_panduan_pinjam" value="{{isset($row) ? $row->id_panduan_pinjam : ''}}">
						<button type="submit" class="btn btn-primary">
							Simpan <span class="fa fa-save"></span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection