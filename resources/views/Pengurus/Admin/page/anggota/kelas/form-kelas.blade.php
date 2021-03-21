@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="row">
		<div class="col-md-12">
			<h1 class="m-0 text-dark">Form Kelas</h1>
		</div>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<a href="{{url('/admin/kelas')}}">
						<button class="btn btn-default">
							<span class="fa fa-long-arrow-left"></span> Kembali
						</button>
					</a>
				</div>
				<form action="{{url('/admin/kelas/save')}}" method="POST">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="" class="form-label">Kelas Tingkat</label>
							<select name="id_kelas_tingkat" class="form-control" required="required">
								<option value="" selected="selected" disabled="disabled">=== Pilih Kelas Tingkat ===</option>
								@foreach ($kelas_tingkat as $element)
								<option value="{{ $element->id_kelas_tingkat }}" @if (isset($row)){!! $row->id_kelas_tingkat == $element->id_kelas_tingkat ? 'selected="selected"' : '' !!}@endif>{{ $element->kelas_tingkat }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="" class="form-label">Jurusan</label>
							<select name="id_jurusan" class="form-control" required="required">
								<option value="" selected="selected" disabled="disabled">=== Pilih Jurusan ===</option>
								@foreach ($jurusan as $element)
								<option value="{{ $element->id_jurusan }}" @if (isset($row)){!! $row->id_jurusan == $element->id_jurusan ? 'selected="selected"' : '' !!}@endif>{{ $element->nama_jurusan }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="tahun-ajaran" class="form-label">Urutan Kelas</label>
							<input type="number" name="urutan_kelas" id="tahun-ajaran" class="form-control" value="{{isset($row)?$row->urutan_kelas:''}}" placeholder="Isi Urutan Kelas;Ex:1;" required="required">
						</div>
					</div>
					<div class="card-footer">
						<input type="hidden" name="id_tipe_anggota" value="{{isset($row)?$row->id_tipe_anggota:''}}">
						<button type="submit" class="btn btn-primary">
							Simpan <span class="fa fa-save"></span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection