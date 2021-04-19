@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Laporan Transaksi Buku</h1>
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
						<form action="{{ url('/admin/data-buku/cetak') }}" method="GET">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<select name="tahun_ajaran" class="form-control select2">
											<option value="" selected="" disabled="">=== Pilih Tahun Ajaran ===</option>
											@foreach ($tahun_ajaran as $value)
											<option value="{{ $value->tahun_ajaran }}">{{ $value->tahun_ajaran }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<button class="btn btn-success">
										Cetak Laporan Daftar Buku
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<form action="{{ url('/admin/transaksi-buku/cetak-laporan-buku') }}" method="GET">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<select name="tahun_ajaran" class="form-control select2">
											<option value="" selected="" disabled="">=== Pilih Tahun Ajaran ===</option>
											@foreach ($tahun_ajaran as $value)
											<option value="{{ $value->tahun_ajaran }}">{{ $value->tahun_ajaran }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<button class="btn btn-success">
										Cetak Laporan Pinjam
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<form action="{{ url('/admin/transaksi-buku/cetak-laporan-buku-k13') }}" method="GET">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<select name="tahun_ajaran" class="form-control select2">
											<option value="" selected="" disabled="">=== Pilih Tahun Ajaran ===</option>
											@foreach ($tahun_ajaran as $value)
											<option value="{{ $value->tahun_ajaran }}">{{ $value->tahun_ajaran }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<button class="btn btn-success">
										Cetak Laporan Peminjaman Buku K-13
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection