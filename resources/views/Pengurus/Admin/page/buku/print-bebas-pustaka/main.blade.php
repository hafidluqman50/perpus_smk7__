@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Print Bebas Pustaka</h1>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<form action="{{ url('/admin/print-bebas-pustaka/cetak-surat') }}" method="GET">
							<div class="form-group">
								<select name="tahun_ajaran" class="form-control select2">
									<option value="" selected="" disabled="">=== Pilih Tahun Ajaran ===</option>
									@foreach ($tahun_ajaran as $value)
									<option value="{{ $value->id_tahun_ajaran }}">{{ $value->tahun_ajaran }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<select name="kelas_tingkat" class="form-control select2">
									<option value="" selected="" disabled="">=== Pilih Kelas Tingkat ===</option>
									@foreach ($kelas_tingkat as $value)
									<option value="{{ $value->id_kelas_tingkat }}">{{ $value->kelas_tingkat }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<select name="jurusan" class="form-control select2">
									<option value="" selected="" disabled="">=== Pilih Jurusan ===</option>
									@foreach ($jurusan as $value)
									<option value="{{ $value->id_jurusan }}">{{ $value->nama_jurusan }}</option>
									@endforeach
								</select>
							</div>
							<button class="btn btn-success">
								Cetak Laporan Daftar Buku
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection