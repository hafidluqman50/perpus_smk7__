@extends('Pengurus.Petugas.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Buku</h1>
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
						<a href="{{url('/petugas/data-buku')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/petugas/data-buku/import/post')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="" class="form-label">File Buku</label>
								<input type="file" name="file_buku" class="form-control">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Foto Buku</label>
								<input type="file" name="foto_buku" class="form-control">
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-primary">
								Import
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection