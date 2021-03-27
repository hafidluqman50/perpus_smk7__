@extends('Pengurus.Petugas.layout.layout-app')

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
				<div class="card">
					<div class="card-header">
						<form action="{{ url('/petugas/data-buku-tamu/export') }}" method="GET">
							<div class="row">
								<div class="col-md-2">
									<a href="{{ url('/petugas/buku-tamu') }}">
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
									<div class="col-md-3">
										<button class="btn btn-success">
											Rekap Buku Tamu <span class="fa fa-excel-o"></span>
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
                {data:'ket_buku_tamu',name:'ket_buku_tamu'}
            ],
            scrollCollapse: true,
            columnDefs: [ {
            sortable: true,
            "class": "index",
            }],
            order: [[ 1, 'desc' ]],
            responsive:true,
            scrollX:true,
            fixedColumns: true
        });
        buku_tamu.on( 'order.dt search.dt', function () {
	        buku_tamu.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
    });
</script>
@endsection