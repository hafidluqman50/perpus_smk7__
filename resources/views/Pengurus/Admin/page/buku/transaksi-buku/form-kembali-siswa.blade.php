@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Kembali</h1>
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
						<a href="{{url('/admin/transaksi-buku/siswa')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/transaksi-buku/kembali/post')}}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="">Tahun Ajaran</label>
								<select id="tahun-ajaran" class="form-control select2" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Tahun Ajaran ===</option>
									@foreach ($tahun_ajaran as $element)
									<option value="{{$element->id_tahun_ajaran}}">{{$element->tahun_ajaran}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="">Kelas</label>
								<select id="kelas" class="form-control select2" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Kelas ===</option>
									@foreach ($kelas as $element)
									<option value="{{$element->id_kelas}}">{{$element->kelas_tingkat.'  '.$element->nama_jurusan.'  '.$element->urutan_kelas}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="">Siswa</label>
								<select name="anggota" class="form-control select2" id="siswa" required="required" disabled="disabled">
									<option selected="selected" disabled="disabled">=== Pilih Siswa ===</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Barcode</label>
								<input type="text" class="form-control" id="barcode" placeholder="Code Barcode">
							</div>
							<div class="form-group">
								<label for="">Buku</label>
								<select name="buku[]" id="buku" class="form-control select-buku" required="required" disabled="disabled" multiple="multiple">
								</select>
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="tipe" value="siswa">
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
	});
</script>
@endsection