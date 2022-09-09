@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Form Aturan Pinjam</h1>
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
						<a href="{{url('/admin/aturan-pinjam')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<form action="{{url('/admin/aturan-pinjam/save')}}" method="POST">
						@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="" class="form-label">Isi Aturan Pinjam</label>
								<textarea name="isi_aturan" id="mytextarea" class="form-control" cols="30" rows="10" placeholder="Isi Aturan Pinjam">{{isset($row) ? $row->isi_aturan : ''}}</textarea>
							</div>
						</div>
						<div class="card-footer">
							<input type="hidden" name="id_aturan_pinjam" value="{{isset($row) ? $row->id_aturan_pinjam : ''}}">
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
      tinymce.init({
        selector: '#mytextarea'
      });
</script>
@endsection