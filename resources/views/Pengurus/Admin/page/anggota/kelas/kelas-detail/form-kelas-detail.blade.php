@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	
</section>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<a href="{{ url('/admin/kelas/detail/'.$id) }}">
							<button class="btn btn-default">
								<span class="fa fa-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{ url('/admin/kelas/detail/'.$id.'/save') }}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="" class="form-label">Tahun Ajaran</label>
								<select name="id_tahun_ajaran" class="form-control select2" required="required">
									<option selected="selected" disabled="disabled">=== Pilih Tahun Ajaran ===</option>
									@foreach($tahun_ajaran as $value)
									<option value="{{$value->id_tahun_ajaran}}" @if(isset($row)){!!$row->id_tahun_ajaran==$value->id_tahun_ajaran?'selected="selected"':''!!}@endif>{{ $value->tahun_ajaran }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="">Kelas</label>
								<input type="text" class="form-control" value="{{ $kelas->kelas_tingkat.' '.$kelas->nama_jurusan.' '.$kelas->urutan_kelas }}" disabled="disabled">
							</div>
							<div class="form-group">
								<label for="">Siswa</label>
								<select name="siswa[]" class="form-control select2 select-siswa" required="required" multiple="multiple">
									@foreach ($siswa as $element)
									<option value="{{ $element->id_anggota }}">{{ $element->nomor_induk.' | '.$element->nama_anggota }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<input type="hidden" name="id_kelas" value="{{ $id }}">
						<div class="card-footer">
							<button class="btn btn-primary">
								Simpan Data <span class="fa fa-save"></span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection