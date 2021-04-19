@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Panduan Pinjam</h1>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<a href="{{ url('/admin/panduan-pinjam/tambah') }}">
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
						<table class="table force-fullwidth panduan-pinjam">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Langkah Panduan</th>
									<th scope="col">Isi Panduan</th>
									<th scope="col">Foto Panduan</th>
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
        var panduan_pinjam = $('.panduan-pinjam').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-panduan-pinjam') }}",
            columns:[
                {data:'id_panduan_pinjam',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'langkah_panduan',name:'langkah_panduan'},
                {data:'isi_panduan',name:'isi_panduan'},
                {data:'foto_panduan',name:'foto_panduan'},
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
        panduan_pinjam.on( 'order.dt search.dt', function () {
	        panduan_pinjam.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
    });
</script>
@endsection