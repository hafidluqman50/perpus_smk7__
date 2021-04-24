@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Data Buku</h1>	
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
						<a href="{{url('/admin/data-buku/tambah')}}">
							<button class="btn btn-primary">
								Tambah Data
							</button>
						</a>
						<a href="{{url('/admin/data-buku/import')}}">
							<button class="btn btn-success">
								Import Buku
							</button>
						</a>
						<a href="{{url('/admin/data-buku/contoh-import')}}">
							<button class="btn btn-success">
								Contoh Format Import
							</button>
						</a>
						<a href="{{ url('/admin/data-buku/cetak-barcode') }}">
							<button class="btn btn-success">
								Cetak Barcode Semua
							</button>
						</a>
						<a href="{{ url('/admin/data-buku/cetak-label') }}">
							<button class="btn btn-success">
								Cetak Label Semua
							</button>
						</a>
					</div>
					<div class="card-body">
						@if(session()->has('message'))
						<div class="alert alert-success alert-dismissible">
							{{ session('message') }} <button class="close" data-dismiss="alert" aria-label="close">X</button>
						</div>
						@elseif(session()->has('log'))
						<div class="alert alert-danger alert-dismissible">
							{{ session('log') }} <button class="close" data-dismiss="alert">X</button>
						</div>
						@endif
						<table class="table force-fullwidth data-buku">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Judul Buku</th>
									<th scope="col">Kategori</th>
									<th scope="col">Sub Kategori</th>
									<th scope="col">Inisial Buku</th>
									<th scope="col">Tahun Buku</th>
									<th scope="col">Pengarang</th>
									<th scope="col">Singkatan Pengarang</th>
									<th scope="col">Penerbit</th>
									<th scope="col">Tahun Terbit</th>
									<th scope="col">Jumlah Eksemplar</th>
									<th scope="col">Klasifikasi</th>
									<th scope="col">Stok Buku</th>
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
        var buku = $('.data-buku').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-buku') }}",
            columns:[
                {data:'id_buku',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                // {data:'nomor_induk',name:'nomor_induk'},
                {data:'judul_buku',name:'judul_buku'},
                {data:'nama_kategori',name:'nama_kategori'},
                {data:'nama_sub',name:'nama_sub'},
                {data:'inisial_buku',name:'inisial_buku'},
                {data:'tahun_buku',name:'tahun_buku'},
                {data:'pengarang',name:'pengarang'},
                {data:'sn_penulis',name:'sn_penulis'},
                {data:'penerbit',name:'penerbit'},
                {data:'tahun_terbit',name:'tahun_terbit'},
                {data:'jumlah_eksemplar',name:'jumlah_eksemplar'},
                {data:'klasifikasi',name:'klasifikasi'},
                {data:'stok_buku',name:'stok_buku'},
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
        buku.on( 'order.dt search.dt', function () {
	        buku.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
	});
</script>
@endsection