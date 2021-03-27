@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Data Petugas</h1>
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
						<a href="{{url('/admin/data-petugas/tambah')}}">
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
						<table class="table force-fullwidth data-petugas">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">NIP</th>
									<th scope="col">Nama Petugas</th>
									<th scope="col">Jabatan</th>
									<th scope="col">Username</th>
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
        var petugas = $('.data-petugas').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-petugas') }}",
            columns:[
                {data:'id_petugas',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'nip',name:'nip'},
                {data:'nama_petugas',name:'nama_petugas'},
                {data:'jabatan',name:'jabatan'},
                {data:'username',name:'username'},
                {data:'status_petugas',name:'status_petugas'},
                {data:'action',name:'action',searchable:false,orderable:false}
            ],
            scrollCollapse: true,
            columnDefs: [ {
            sortable: true,
            "class": "index",
            targets: 0
            }],
            order: [[ 1, 'desc' ]],
            scrollX:true,
            fixedColumns: true
        });
        petugas.on( 'order.dt search.dt', function () {
	        petugas.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
    });
</script>
@endsection