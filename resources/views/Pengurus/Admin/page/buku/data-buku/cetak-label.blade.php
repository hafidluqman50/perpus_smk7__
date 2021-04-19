<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{asset('admin-assets/dist/css/adminlte.min.css')}}">
	<title>Cetak Labels</title>
	<style>
		@page {
			margin:0!important;
		}
		h6 {
  			font-family: "Times New Roman", Times, serif;
		}
		.row {
			margin-top:14px;
		}
		.layout-label {
			width:8.13cm;
			height:3.56cm;
			border: 1px solid black;
			margin-left:auto;
			margin-right: auto;
			margin-bottom:9%;
			position: relative;
		}
		.layout-label::before {
			content:"";
			position:absolute;
			z-index: -1;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			background-image: url('/admin-assets/dist/Logo_SMKN_7_Samarinda.png');
			background-repeat: no-repeat;
			background-position: center;
			background-size:3.3cm 3.3cm;
			filter: grayscale(100%);
			opacity: 0.3;
		}
		.label-header {
			width: 100%;
			height:1.4cm;
			border-bottom: 1px solid black;
		}
		.label-body {
			width:100%;
			/*height:2cm;*/
		}
		.page-break-after{
			clear: both;
			page-break-after: always;
		}
	</style>
</head>
<body>
	{{-- <div class="container"> --}}
		@php
			$count = 0;
			$judul = 1;
		@endphp
		@foreach ($buku as $key => $value)
			@for ($i = 0; $i < $value->stok_buku; $i++)
				@if ($count % 2 == 0)
				<div class="row">
				@endif
					<div class="col-md-6">
						<div class="layout-label bg-watermark">
							<div class="label-header">
								<h6 align="center" style="margin-top:1%;"><b>PERPUSTAKAAN</b></h6>
								<h6 align="center"><b>SMK NEGERI 7 SAMARINDA</b></h6>
							</div>
							<div class="label-body">
								<h6 align="center" style="margin-top:1%;"><b>{{ $value->klasifikasi }}</b></h6>
								<h6 align="center"><b>{{ $value->sn_penulis }}</b></h6>
								<h6 align="center"><b>{{ $value->inisial_buku }}</b></nav></h6>
							</div>
							<h5 align="center">{{ $value->judul_buku }}</h5>
						</div>
					</div>
				@if ($count % 2 != 0)
				</div>
				@endif
				@php 
					$count = $count + 1;
				@endphp
				@if ($count % 16 == 0)
				<div class="page-break-after"></div>
				@endif
			@endfor
		@endforeach
	{{-- </div> --}}
</body>
</html>

<script>
	window.print();
</script>