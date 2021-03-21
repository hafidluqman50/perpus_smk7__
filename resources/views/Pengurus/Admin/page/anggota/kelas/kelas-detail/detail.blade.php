@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="row">
		<div class="col-md-12">
			<h1 class="m-0 text-dark">Detail Kelas</h1>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<a href="{{ url('/admin/kelas') }}">
							<button class="btn btn-default">
								<span class="fa fa-arrow-left"></span> Kembali
							</button>
						</a>
						<a href="{{ url('/admin/kelas/detail/'.$id.'/tambah') }}">
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
						<table class="table force-fullwidth kelas-detail">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">NISN</th>
									<th scope="col">Nama Siswa</th>
									<th scope="col">Kelas</th>
									<th scope="col">Tahun Ajaran</th>
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
        var kelas_detail = $('.kelas-detail').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/kelas/detail/'.$id) }}",
            columns:[
                {data:'id_anggota_perpus',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'nomor_induk',name:'nomor_induk'},
                {data:'nama_anggota',name:'nama_anggota'},
                {data:'kelas_siswa',name:'kelas_siswa'},
                {data:'tahun_ajaran',name:'tahun_ajaran'},
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
        kelas_detail.on( 'order.dt search.dt', function () {
	        kelas_detail.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
	});
</script>
@endsection