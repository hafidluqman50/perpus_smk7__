@extends('Pengurus.Admin.layout.layout-app')

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
						<a href="{{url('/admin/data-buku')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/data-buku/save')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="card-body">{{-- 
							<div class="form-group">
								<label for="" class="form-label">Nomor Induk</label>
								<input type="number" class="form-control" name="nomor_induk">
							</div> --}}
							<div class="form-group">
								<label for="" class="form-label">Judul Buku</label>
								<input type="text" class="form-control" name="judul_buku" value="{{isset($row)?$row->judul_buku:''}}" placeholder="Isi Judul Buku" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Kategori Buku</label>
								<select class="form-control select2" id="kategori-buku" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Kategori ===</option>
									@foreach($kategori as $value)
									<option value="{{$value->id_kategori_buku}}" @if(isset($row)){!!$row->id_kategori_buku==$value->id_kategori_buku?'selected="selected"':''!!}@endif>{{ $value->nama_kategori }}</option>
									@endforeach
									{{-- <option value=""></option> --}}
								</select>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Sub Kategori</label>
								<select name="sub_ktg" class="form-control select2" id="sub-kategori" {!!isset($sub_ktg)?'':'disabled="disabled"'!!} required="required">
									<option selected="selected" disabled="disabled">=== Pilih Sub Kategori ===</option>
									@if(isset($sub_ktg))
										@foreach($sub_ktg->showKategori($row->id_kategori_buku) as $value)
										<option value="{{$value->id_sub_ktg}}" @if(isset($row)){!!$row->id_sub_ktg==$value->id_sub_ktg?'selected="selected"':''!!}@endif>{{$value->nama_sub}}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Inisial Buku</label>
								<input type="text" class="form-control" name="inisial_buku" value="{{isset($row) ? $row->inisial_buku : ''}}" required="" placeholder="Isi Inisial Buku">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Pengarang</label>
								<input type="text" class="form-control" name="pengarang" value="{{isset($row)?$row->pengarang:''}}" placeholder="Isi Nama Pengarang">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Singkatan Penulis</label>
								<input type="text" class="form-control" name="sn_penulis" value="{{isset($row)?$row->sn_penulis:''}}" placeholder="Isi Singkatan Penulis" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Penerbit</label>
								<input type="text" class="form-control" name="penerbit" value="{{isset($row)?$row->penerbit:''}}" placeholder="Isi Penerbit Buku" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Tempat Terbit</label>
								<input type="text" class="form-control" name="tempat_terbit" value="{{isset($row)?$row->tempat_terbit:''}}" placeholder="Isi Tempat Terbit" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Tahun Terbit</label>
								<input type="number" class="form-control" name="tahun_terbit" value="{{isset($row)?$row->tahun_terbit:''}}" placeholder="Isi Tahun Terbit" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Tahun Buku</label>
								<input type="number" class="form-control" name="tahun_buku" value="{{isset($row)?$row->tahun_buku:''}}" placeholder="Isi Tahun Buku" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Klasifikasi</label>
								<input type="text" class="form-control" name="klasifikasi" value="{{isset($row)?$row->klasifikasi:''}}" placeholder="Isi Klasifikasi" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Jumlah Eksemplar</label>
								<input type="number" class="form-control" name="jumlah_eksemplar" value="{{isset($row)?$row->jumlah_eksemplar:''}}" placeholder="Isi Jumlah Eksemplar" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Stok Buku</label>
								<input type="number" class="form-control" name="stok_buku" value="{{isset($row)?$row->stok_buku:''}}" placeholder="Isi Stok Buku" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Foto Buku</label>
								<img id="uploadPreview" class="img-fluid">
								<input type="file" id="image" name="foto_buku" class="form-control">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Keterangan</label>
								<textarea name="keterangan" class="form-control" id="" cols="30" rows="10" placeholder="Isi Keterangan Jika Diperlukan">{{isset($row)?$row->keterangan:''}}</textarea>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Jenis Buku</label>
								<select name="jenis_buku" class="form-control select2">
									<option value="" selected="" disabled="">=== Pilih Jenis Buku ===</option>
									<option value="buku-bacaan" @if(isset($row)){!!$row->jenis_buku=='buku-bacaan'?'selected="selected"':''!!}@endif>Buku Bacaan</option>
									<option value="buku-pelajaran-kelas-x" @if(isset($row)){!!$row->jenis_buku=='buku-pelajaran-kelas-x'?'selected="selected"':''!!}@endif>Buku Pelajaran Kelas X</option>
									<option value="buku-pelajaran-kelas-xi" @if(isset($row)){!!$row->jenis_buku=='buku-pelajaran-kelas-xi'?'selected="selected"':''!!}@endif>Buku Pelajaran Kelas XI</option>
									<option value="buku-pelajaran-kelas-xii" @if(isset($row)){!!$row->jenis_buku=='buku-pelajaran-kelas-xii'?'selected="selected"':''!!}@endif>Buku Pelajaran Kelas XII</option>
								</select>
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="id_buku" value="{{isset($row)?$row->id_buku:''}}">
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
		var host = window.location.host;
		var protocol = window.location.protocol;
		$('#kategori-buku').change(function(){
			var val = $(this).val();
			var getUrl = protocol+'//'+host+'/ajax/get-sub/'+val
			$.ajax({
				url: getUrl,
			})
			.done(function(success) {
				console.log(success);
				if ($('#sub-kategori').attr('disabled') == 'disabled') {
					$('#sub-kategori').removeAttr('disabled');
				}
				$('#sub-kategori').html(success);
			})
			.fail(function(error) {
				console.log(error);
			});
		});
	});
</script>
@endsection