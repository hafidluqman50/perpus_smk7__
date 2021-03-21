@extends('Pengurus.Admin.layout.layout-app')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="m-0 text-dark">Detail Transaksi</h1>
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
						<a href="{{url('/admin/transaksi-buku/siswa')}}">
							<button class="btn btn-default">
								<span class="fa fa-long-arrow-left"></span> Kembali
							</button>
						</a>
					</div>
					<div class="card-body">
						@if (session()->has('message'))
							@foreach (session('message') as $element)
							<div class="alert {{$element['class']}} alert-dismissible">{!!$element['text']!!} <button class="close">X</button></div>
							@endforeach
						@endif
						<h6>Tahun Ajaran : <b>{{$siswa->tahun_ajaran}}</b></h6>
						<h6>Nama Siswa : <b>{{$siswa->nama_anggota}}</b></h6>
						<h6>Kelas : <b>{{$siswa->kelas_tingkat.' '.$siswa->nama_jurusan.' '.$siswa->urutan_kelas}}</b></h6>
						<table class="table force-fullwidth transaksi-detail">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Judul Buku</th>
									<th scope="col">Tanggal Pinjam</th>
									<th scope="col">Tanggal Harus Kembali</th>
									<th scope="col">Tanggal Kembali</th>
									<th scope="col">Denda</th>
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
		// var daguy = window.location.pathname;
        var transaksi_detail = $('.transaksi-detail').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ url('/datatables/data-detail-transaksi/'.$id.'/siswa') }}",
            columns:[
                {data:'id_detail_transaksi',searchable:false,render:function(data,type,row,meta){
                    return meta.row + meta.settings._iDisplayStart+1;
                }},
                {data:'judul_buku',name:'judul_buku'},
                {data:'tanggal_pinjam',name:'tanggal_pinjam'},
                {data:'tanggal_harus_kembali',name:'tanggal_harus_kembali'},
                {data:'tanggal_kembali',name:'tanggal_kembali'},
                {data:'denda',name:'denda'},
                {data:'status_transaksi',name:'status_transaksi'},
                {data:'action',name:'action',searchable:false,orderable:false}
            ],
            scrollCollapse: true,
            columnDefs: [ {
            sortable: true,
            "class": "index",
            }],
            order: [[ 6, 'desc' ]],
            responsive:true,
            scrollX:true,
            fixedColumns: true
        });
        transaksi_detail.on( 'order.dt search.dt', function () {
	        transaksi_detail.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	        	cell.innerHTML = i+1;
	        });
        }).draw();
	});
</script>
@endsection