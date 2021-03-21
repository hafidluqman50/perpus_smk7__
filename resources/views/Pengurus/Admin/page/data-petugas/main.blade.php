@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Data Petugas</h1>
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
						<a href="{{url('/admin/data-petugas/tambah')}}">
							<button class="btn btn-primary">
								Tambah Data
							</button>
						</a>
					</div>
					<div class="card-body">
						@if(session()->has('message'))
						<div class="alert alert-success alert-dismissible">
							{{ session('message') }} <button class="close" data-dismiss="alert">X</button>
						</div>
						@elseif(session()->has('log'))
						<div class="alert alert-danger alert-dismissible">
							{{ session('log') }} <button class="close" data-dismiss="alert">X</button>
						</div>
						@endif
						<table class="table force-fullwidth data-petugas">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Nomor Induk</th>
									<th scope="col">Nama Petugas</th>
									<th scope="col">Username</th>
									<th scope="col">Status</th>
									<th scope="col">#</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection