@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Konfirmasi Siswa</h1>
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
						<a href="{{url('/admin/transaksi-buku/detail-transaksi/siswa/'.$id)}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/transaksi-buku/detail-transaksi/konfirmasi-post')}}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="">Tahun Ajaran</label>
								<input type="text" class="form-control" value="{{ $konfirmasi->tahun_ajaran }}" disabled="disabled">
							</div>
							<div class="form-group">
								<label for="">Kelas</label>
								<input type="text" class="form-control" value="{{ $konfirmasi->kelas_tingkat.' '.$konfirmasi->nama_jurusan.' '.$konfirmasi->urutan_kelas }}" disabled="disabled">
							</div>
							<div class="form-group">
								<label for="">Siswa</label>
								<input type="text" class="form-control" value="{{ $konfirmasi->nama_anggota }}" disabled="disabled">
							</div>
							<div class="form-group">
								<label for="">Buku</label>
								<input type="text" class="form-control" value="{{ $konfirmasi->judul_buku }}" disabled="disabled">
							</div>
							<hr>
							<button class="btn btn-primary" id="input-barcode" type="button">Scan Barcode</button>
							<hr>
							<div class="is-hide" id="scan-barcode">
								<div class="form-group">
									<label for="">Barcode</label>
									<input type="text" name="barcode" class="form-control" placeholder="Code Barcode">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="tipe" value="siswa">
							<input type="hidden" name="id_transaksi" value="{{ $id }}">
							<input type="hidden" name="id_detail_transaksi" value="{{ $id_detail }}">
							<button type="submit" class="btn btn-primary">
								Konfirmasi <span class="fa fa-check"></span>
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
<script>
	$('#input-barcode').click(function() {
		if ($('#scan-barcode').hasClass('is-hide')) {
			$('#scan-barcode').removeClass('is-hide')
			$('#scan-barcode .form-group').find('input').attr('required','required')
		}
		else {
			$('#scan-barcode').addClass('is-hide')
			$('#scan-barcode .form-group').find('input').removeAttr('required','required')
			$('#scan-barcode .form-group').find('input').val('')
		}
	})
</script>
@endsection