@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Sub Kategori</h1>
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
						<a href="{{url('/admin/sub-kategori',$id)}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/sub-kategori/save')}}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="" class="form-label">Nama Sub Kategori</label>
								<input type="text" name="nama_sub" class="form-control" value="{{isset($row)?$row->nama_sub:''}}" placeholder="Isi Nama Sub" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Deskripsi Sub Kategori</label>
								<textarea name="deskripsi_sub" class="form-control" id="" cols="30" rows="10" placeholder="Isi Deskripsi Sub Kategori" required="required">{{isset($row)?$row->deskripsi_sub:''}}</textarea>
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="kategori" value="{{$id}}">
							<input type="hidden" name="id_sub_ktg" value="{{isset($row)?$row->id_sub_ktg : ''}}">
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

@section('js')

@endsection