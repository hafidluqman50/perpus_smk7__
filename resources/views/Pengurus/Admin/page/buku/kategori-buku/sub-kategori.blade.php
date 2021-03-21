@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Data Sub Kategori Buku</h1>
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
						<a href="{{url('/admin/kategori-buku')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
						<a href="{{url('/admin/sub-kategori/tambah',$id)}}">
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
						<table class="table force-fullwidth data-sub-kategori">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Nama Kategori</th>
									<th scope="col">Nama Sub Kategori</th>
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
        var sub_kategori = $('.data-sub-kategori').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-sub-kategori',$id) }}",
            columns:[
                {data:'id_sub_ktg',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'nama_kategori',name:'nama_kategori'},
                {data:'nama_sub',name:'nama_sub'},
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
        sub_kategori.on( 'order.dt search.dt', function () {
	        sub_kategori.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
	});
</script>
@endsection