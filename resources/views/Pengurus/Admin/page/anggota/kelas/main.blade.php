@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<div class="content-header">
	<div class="row">
		<div class="col-md-12">
			<h1 class="m-0 text-dark">Data Kelas</h1>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<a href="{{ url('/admin/kelas/tambah') }}">
							<button class="btn btn-primary">
								Tambah Data
							</button>
						</a>
					</div>
					<div class="card-body">
						@if(session()->has('message'))
						<div class="alert alert-success alert-dismissible">
							{{ session('message') }} <button class="close">X</button>
						</div>
						@endif
						<table class="table force-fullwidth kelas">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Kelas</th>
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
        var kelas = $('.kelas').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/kelas') }}",
            columns:[
                {data:'id_kelas',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'nama_kelas',name:'nama_kelas'},
                {data:'action',name:'action',searchable:false,orderable:false}
            ],
            scrollCollapse: true,
            columnDefs: [ {
            sortable: true,
            columnsWidth:"100%",
            "class": "index",
            }],
            order: [[ 1, 'desc' ]],
            scrollX:true,
            responsive:true,
            fixedColumns: true
        });
        kelas.on( 'order.dt search.dt', function () {
	        kelas.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
    });
</script>
@endsection