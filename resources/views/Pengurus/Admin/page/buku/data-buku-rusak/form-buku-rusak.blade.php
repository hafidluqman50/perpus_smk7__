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
						<a href="{{url('/admin/data-buku-rusak')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/data-buku-rusak/save')}}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="" class="form-label">Buku</label>
								<select name="buku" class="form-control select2" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Buku ===</option>
									@foreach($data_buku as $value)
									<option value="{{$value->id_buku}}" @if(isset($row)){!!$row->id_buku==$value->id_buku?'selected="selected"':''!!}@endif>{{ $value->judul_buku }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="" class="form-label">Stok Rusak</label>
								<input type="number" class="form-control" name="stok_rusak" value="{{isset($row)?$row->stok_rusak:''}}" placeholder="Isi Stok Rusak" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Keterangan</label>
								<textarea name="keterangan" id="" class="form-control" cols="30" rows="10" required="required" placeholder="Isi Keterangan; Ex: Halaman Sobek;">{{isset($row)?$row->ket_buku_rusak:''}}</textarea>
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="id_buku_rusak" value="{{isset($row)?$row->id_buku_rusak:''}}">
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