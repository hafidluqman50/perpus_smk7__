@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Pinjam</h1>
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
						<a href="{{url('/admin/transaksi-buku/guru')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/transaksi-buku/pinjam/post')}}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="">Guru</label>
								<select name="anggota" class="form-control select2" required="required">
									<option value="" selected="selected" disabled="disabled">=== Pilih Guru ===</option>
									@foreach ($guru as $data)
									<option value="{{ $data->id_anggota_perpus }}">{{ $data->nomor_induk.' | '.$data->nama_anggota }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="">Tanggal Pinjam</label>
								<input type="date" name="tanggal_pinjam" class="form-control" value="{{ date('Y-m-d') }}" readonly="readonly">
							</div>
							<div class="form-group">
								<label for="">Tanggal Harus Kembali</label>
								<input type="date" name="tanggal_harus_kembali" class="form-control" value="{{ dua_minggu(date('Y-m-d')) }}">
							</div>
							<hr>
							<button class="btn btn-primary" id="scan-barcode" type="button">Scan Barcode</button>
							<button class="btn btn-primary is-hide" id="input-manual" type="button">Input Manual</button>
							<hr>
							<div class="input-manual">
								<div class="form-group">
									<label for="">Buku</label>
									<select name="buku_manual[]" id="buku_manual" class="form-control select-buku" required="required" multiple="">
										@foreach ($data_buku as $element)
										<option value="{{$element->id_buku}}">{{ $element->judul_buku }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="input-barcode is-hide">
								<div class="form-group">
									<label for="">Barcode</label>
									<input type="text" class="form-control" id="barcode" placeholder="Code Barcode">
								</div>
								<div class="form-group">
									<label for="">Buku</label>
									<select name="buku_barcode[]" id="buku" class="form-control select-buku" disabled="disabled" multiple="multiple">
									</select>
								</div>
							</div>
							{{-- <div class="form-group">
								<label for="">Tanggal Pinjam</label>
								<input type="text" class="form-control" name="tanggal_pinjam" value="{{date_explode(date('Y-m-d'))}}" readonly="readonly">
							</div>
							<div class="form-group">
								<label for="">Tanggal Harus Kembali</label>
								<input type="text" class="form-control" name="tanggal_harus_kembali" value="{{date_explode(dua_minggu(date('Y-m-d')))}}" readonly="readonly">
							</div> --}}
						</div>
						<div class="card-footer">
							<input type="hidden" name="tipe" value="guru">
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
<script>
	$(function(){
		$('#barcode').keydown(function(e){
			var val = $(this).val();
			if (e.keyCode == 13) {
				e.preventDefault();
			}
			var getUrl = window.location.origin+'/ajax/get-buku-barcode/'+val;
			if (val != '' && e.keyCode == 13) {
				$.ajax({
					url: getUrl,
				})
				.done(function(success) {
					if ($('#buku').is(':disabled')) {	
						$('#buku').removeAttr('disabled');
					}
					$('#buku').append(success);
					$('#barcode').val('');
				})
				.fail(function(error) {
					console.log(error);
				});
			}
		});

		$('#tahun-ajaran').change(function(){
			var val = $(this).val();
			var val_juga = $('#kelas').val();
			if (val_juga != null) {
				var getUrl = window.location.origin+'/ajax/get-siswa/'+val+'/'+val_juga;
				$.ajax({
					url: getUrl,
				})
				.done(function(success) {
					if ($('#siswa').is(':disabled')) {
						$('#siswa').removeAttr('disabled');
					}
					$('#siswa').html(success);
				})
				.fail(function(error) {
					console.log(error);
				});
			}
		});

		$('#kelas').change(function(){
			var val = $(this).val();
			var val_juga = $('#tahun-ajaran').val();
			if (val_juga != null) {
				var getUrl = window.location.origin+'/ajax/get-siswa/'+val_juga+'/'+val;
				$.ajax({
					url: getUrl,
				})
				.done(function(success) {
					if ($('#siswa').is(':disabled')) {
						$('#siswa').removeAttr('disabled');
					}
					$('#siswa').html(success);
				})
				.fail(function(error) {
					console.log(error);
				});
			}
		});

		$('#scan-barcode').click(function() {
			$('.input-barcode').removeClass('is-hide');
			$('.input-manual').addClass('is-hide');
			$(this).addClass('is-hide');
			$('#input-manual').removeClass('is-hide');
			$('#buku_manual').attr('disabled','disabled');
			$('#buku_manual').removeAttr('required');
			$('.select-buku').select2({
				placeholder:"=== Pilih Buku ==="
			})
		})

		$('#input-manual').click(function() {
			$('.input-manual').removeClass('is-hide');
			$('.input-barcode').addClass('is-hide');
			$(this).addClass('is-hide');
			$('#scan-barcode').removeClass('is-hide');
			$('#buku').attr('disabled','disabled');
			$('#buku').removeAttr('required');
			$('#buku_manual').attr('required','required');
			$('#buku_manual').removeAttr('disabled');
			$('.select-buku').select2({
				placeholder:"=== Pilih Buku ==="
			})
		})
	});
</script>
@endsection