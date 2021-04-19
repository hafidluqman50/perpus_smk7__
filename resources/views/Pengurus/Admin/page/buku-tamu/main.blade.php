@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<div class="content-header">
	<div class="row">
		<div class="col-md-12">
			<h1 class="m-0 text-dark">Data Buku Tamu</h1>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="modal fade" id="modalPinBukuTamu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Pin Buku Tamu</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      	<input type="text" class="form-control" name="pin_buku_tamu" value="{{ $pin_buku_tamu[0]->pin_buku_tamu }}" placeholder="Masukkan Pin Buku Tamu">
				      	<input type="hidden" name="id_pin_buku_tamu" value="{{ $pin_buku_tamu[0]->id_pin_buku_tamu }}">
				      </div>
				      <div class="modal-footer">
				        <button type="button" id="submit_pin" class="btn {{ isset($pin_buku_tamu[0]) ? 'btn-warning' : 'btn-primary' }}">Simpan</button>
				      </div>
				    </div>
				  </div>
				</div>
				<div class="card">
					<div class="card-header">
						<form action="{{ url('/admin/data-buku-tamu/export') }}" method="GET">
							<div class="row">
								<div class="col-md-2">
									<a href="{{ url('/admin/buku-tamu') }}">
										<button class="btn btn-primary" type="button">
											Input Buku Tamu
										</button>
									</a>	
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<select name="tahun_ajaran" class="form-control select2">
											<option value="" selected="" disabled="">=== Pilih Tahun Ajaran ===</option>
											@foreach ($tahun_ajaran as $value)
											<option value="{{$value->tahun_ajaran}}">{{$value->tahun_ajaran}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<button class="btn btn-success">
										Rekap Buku Tamu <span class="fa fa-excel-o"></span>
									</button>
								</div>
								<div class="col-md-3">
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalPinBukuTamu">
										Pin Buku Tamu
									</button>
								</div>
							</div>
						</form>
					</div>
					<div class="card-body">
						@if(session()->has('message'))
						<div class="alert alert-success alert-dismissible">
							{{ session('message') }} <button class="close" type="button" data-dismiss="alert">X</button>
						</div>
						@endif
						<table class="table force-fullwidth data-buku-tamu">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Tanggal Berkunjung</th>
									<th scope="col">Nama Anggota</th>
									<th scope="col">Kelas/Jabatan</th>
									<th scope="col">Keterangan</th>
									<th scope="col">#</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('js')

<script>
	
    $(function(){
        var buku_tamu = $('.data-buku-tamu').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-buku-tamu') }}",
            columns:[
                {data:'id_buku_tamu',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'tanggal_berkunjung',name:'tanggal_berkunjung'},
                {data:'nama_anggota',name:'nama_anggota'},
                {data:'kelas_jabatan',name:'kelas_jabatan'},
                {data:'ket_buku_tamu',name:'ket_buku_tamu'},
                {data:'action',name:'action',searchable:false,orderable:false}
            ],
            scrollCollapse: true,
            columnDefs: [ {
            sortable: true,
            "class": "index",
            }],
            order: [[ 0, 'desc' ]],
            responsive:true,
            scrollX:true,
            fixedColumns: true
        });
        buku_tamu.on( 'order.dt search.dt', function () {
	        buku_tamu.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();

		$('#submit_pin').click(() => {
			$('#submit_pin').html('Loading...').attr('disabled','disabled')
			let getUrl = window.location.origin+'/ajax/pin-buku-tamu/edit';
			
			let get_pin = $('input[name="pin_buku_tamu"]').val()
			let id_pin_buku_tamu = $('input[name="id_pin_buku_tamu"]').val()

			$.ajax({
				url: getUrl,
				type: 'GET',
				data: {pin_buku_tamu: get_pin,id_pin_buku_tamu:id_pin_buku_tamu},
			})
			.done((param) => {
				$('.select2').select2()
				$('#submit_pin').html('Submit').removeAttr('disabled')
				$('#modalPinBukuTamu').modal('hide')
			})
			.fail((error) => {
				console.log(error);
			})
		})
    });
</script>
@endsection