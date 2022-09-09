@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="row">
		<div class="col-md-12">
			<h1 class="m-0 text-dark">Data Siswa</h1>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<a href="{{ url('/admin/data-anggota/siswa/tambah') }}">
							<button class="btn btn-primary">
								Tambah Data
							</button>
						</a>
					</div>
					<div class="card-body">
						@if(session()->has('message'))
						<div class="alert alert-success alert-dismissible">
							{{ session('message') }} <button class="close" data-dismiss="alert">X</button>
						</div>
						@elseif(session()->has('log'))
						<div class="alert alert-danger alert-dismissible">
							{{ session('log') }} <button class="close" data-dismiss="alert">X</button>
						</div>
						@endif
						<table class="table force-fullwidth data-siswa">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">NISN</th>
									<th scope="col">Nama</th>
									<th scope="col">Username</th>
									{{-- <th scope="col">Email</th>
									<th scope="col">No HP</th> --}}
									<th scope="col">Status</th>
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
        var anggota = $('.data-siswa').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-anggota/siswa') }}",
            columns:[
                {data:'id_anggota',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'nomor_induk',name:'nomor_induk'},
                {data:'nama_anggota',name:'nama_anggota'},
                {data:'username',name:'username'},
                // {data:'email',name:'email'},
                // {data:'nmr_hp',name:'nmr_hp'},
                {data:'status_anggota',name:'status_anggota'},
                {data:'action',name:'action',searchable:false,orderable:false}
            ],
            scrollCollapse: true,
            columnDefs: [ {
            sortable: true,
            width:"100%",
            "class": "index",
            }],
            order: [[ 0, 'asc' ]],
            responsive:true,
            // scrollCollaps:true,
            scrollX:true,
            fixedColumns: true
        });
        anggota.on( 'order.dt search.dt', function () {
	        anggota.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
    });
</script>
@endsection
