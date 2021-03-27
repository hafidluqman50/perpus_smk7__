@extends('Pengurus.Petugas.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Data Buku Rusak</h1>	
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
						<a href="{{url('/petugas/data-buku-rusak/tambah')}}">
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
						<table class="table force-fullwidth data-buku-rusak">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Judul Buku</th>
									<th scope="col">Stok Rusak</th>
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
        var buku_rusak = $('.data-buku-rusak').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-buku-rusak') }}",
            columns:[
                {data:'id_buku_rusak',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'judul_buku',name:'judul_buku'},
                {data:'stok_rusak',name:'stok_rusak'},
                {data:'ket_buku_rusak',name:'ket_buku_rusak'},
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
        buku_rusak.on( 'order.dt search.dt', function () {
	        buku_rusak.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
	});
</script>
@endsection