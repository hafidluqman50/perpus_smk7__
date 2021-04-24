@extends('Pengurus.Petugas.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Transaksi Buku</h1>
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
						<a href="{{url('/petugas/transaksi-buku/siswa/pinjam')}}">
							<button class="btn btn-primary" type="button">
								Pinjam Buku
							</button>
						</a>
						<a href="{{url('/petugas/transaksi-buku/siswa/kembali')}}">
							<button class="btn btn-info" type="button">
								Kembalikan Buku
							</button>
						</a>
					</div>
					<div class="card-body">
						@if (session()->has('message'))
							<div class="alert alert-success alert-dismissible">{{session('message')}} <button class="close" data-dismiss="alert">X</button></div>
						@endif
						<table class="table force-fullwidth transaksi-buku">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">NISN</th>
									<th scope="col">Tahun Ajaran</th>
									<th scope="col">Nama Siswa</th>
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
		// var daguy = window.location.pathname;
        var transaksi = $('.transaksi-buku').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-transaksi/siswa') }}",
            columns:[
                {data:'id_transaksi',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'nomor_induk',name:'nomor_induk'},
                {data:'tahun_ajaran',name:'tahun_ajaran'},
                {data:'nama_anggota',name:'nama_anggota'},
                {data:'kelas_siswa',name:'kelas_siswa'},
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
        transaksi.on( 'order.dt search.dt', function () {
	        transaksi.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
	});
</script>
@endsection