@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Surat Bebas Pustaka</h1>
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
						<a href="{{url('/admin/surat-bebas-pustaka')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/surat-bebas-pustaka/save')}}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="" class="form-label">Nomor Surat</label>
								<input type="text" class="form-control" name="nomor_surat" value="{{isset($row)?$row->nomor_surat:''}}" placeholder="Isi Nomor Surat" required="required">
							</div>
							<div class="form-group">
								<label for="" class="form-label">Tahun Ajaran</label>
								<select name="tahun_ajaran" class="form-control select2" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Tahun Ajaran ===</option>
									@foreach($tahun_ajaran as $value)
									<option value="{{$value->id_tahun_ajaran}}" @if(isset($row)){!!$row->id_tahun_ajaran==$value->id_tahun_ajaran?'selected="selected"':''!!}@endif>{{ $value->tahun_ajaran }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="id_surat_bebas_pustaka" value="{{isset($row)?$row->id_surat_bebas_pustaka:''}}">
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