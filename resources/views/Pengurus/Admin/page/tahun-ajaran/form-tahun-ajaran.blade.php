@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<div class="content-header">
	<div class="row">
		<div class="col-md-12">
			<h1 class="m-0 text-dark">Form Tahun Ajaran</h1>
		</div>
	</div>
</div>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<div class="card">
				<div class="card-header">
					<a href="{{url('/admin/tahun-ajaran')}}">
						<button class="btn btn-default">
							<span class="fa fa-long-arrow-left"></span> Kembali
						</button>
					</a>
				</div>
				<form action="{{url('/admin/tahun-ajaran/save')}}" method="POST">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="tahun-ajaran" class="form-label">Tahun Ajaran</label>
							<input type="text" name="tahun_ajaran" id="tahun-ajaran" class="form-control" value="{{isset($row)?$row->tahun_ajaran:''}}" placeholder="Isi Tahun Ajaran; Ex: 2018/2017" required="required">
						</div>
					</div>
					<div class="card-footer">
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