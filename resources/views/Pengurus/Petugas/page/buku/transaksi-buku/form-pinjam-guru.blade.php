@extends('Pengurus.Petugas.layout.layout-app')

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
						<a href="{{url('/petugas/transaksi-buku/guru')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/petugas/transaksi-buku/pinjam/post')}}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="">Guru</label>
								<select name="anggota" class="form-control select2" id="siswa" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Guru ===</option>
									@foreach($guru as $data)
									<option value="{{$data->id_anggota_perpus}}">{{$data->nama_anggota}}</option>
									@endforeach
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
							</div>{{-- 
							<div class="form-group">
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
	});
</script>
@endsection