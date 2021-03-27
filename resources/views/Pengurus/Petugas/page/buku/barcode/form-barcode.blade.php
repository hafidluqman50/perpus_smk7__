@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Barcode</h1>
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
						<a href="{{url('/admin/barcode-buku')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/barcode-buku/save')}}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="" class="form-label">Kategori Buku</label>
								<select id="kategori-barcode" class="form-control select2" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Kategori ===</option>
									@foreach ($kategori as $value)
									<option value="{{$value->id_kategori_buku}}" @if(isset($row)){!!$row->id_kategori_buku==$value->id_kategori_buku ? 'selected="selected"':''!!}@endif>{{$value->nama_kategori}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Sub Kategori Buku</label>
								<select id="sub-ktg-barcode" class="form-control select2" {!!isset($row)?'':'disabled="disabled"'!!} required="required">
									<option selected="selected" disabled="disabled">=== Pilih Sub Kategori ===</option>
									@if (isset($row))
									@foreach ($sub_ktg->showKategori($row->id_kategori_buku) as $element)
									<option value="{{$element->id_sub_ktg}}"@if(isset($row)){!!$row->id_sub_ktg==$element->id_sub_ktg?'selected="selected"':''!!}@endif>{{$element->nama_sub}}</option>
									@endforeach
									@endif
								</select>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Buku</label>
								<select name="buku" class="form-control select2" id="buku-barcode" {!!isset($row)?'':'selected="selected"'!!} required="required">
									<option selected="selected" disabled="disabled">=== Pilih Buku ===</option>
									@if (isset($row))
									@foreach ($buku->showBySub($row->id_sub_ktg) as $element)
									<option value="{{$element->id_buku}}" @if(isset($row)){!!$row->id_buku==$element->id_buku?'selected="selected"':''!!}@endif>{{$element->judul_buku}}</option>
									@endforeach
									@endif
								</select>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Kode Barcode</label>
								<input type="text" class="form-control" name="code_barcode" value="{{isset($row)?$row->code_scanner:''}}" placeholder="Isi Barcode" required="required">
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary">
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
		
		$('#kategori-barcode').change(function(){
			var val = $(this).val();
			var getUrl = protocol+'//'+host+'/ajax/get-sub/'+val;
			$.ajax({
				url: getUrl,
			})
			.done(function(success) {
				if ($('#sub-ktg-barcode').attr('disabled') == 'disabled') {
					$('#sub-ktg-barcode').removeAttr('disabled');
				}
				$('#sub-ktg-barcode').html(success);
			})
			.fail(function(error) {
				console.log(error);
			});
		});

		$('#sub-ktg-barcode').change(function(){
			var val = $(this).val();
			var getUrl = protocol+'//'+host+'/ajax/get-buku/'+val;
			$.ajax({
				url: getUrl,
			})
			.done(function(success) {
				if ($('#buku-barcode').attr('disabled') == 'disabled') {
					$('#buku-barcode').removeAttr('disabled');
				}
				$('#buku-barcode').html(success);
			})
			.fail(function(error) {
				console.log(error);
			});
		});
	});
</script>
@endsection