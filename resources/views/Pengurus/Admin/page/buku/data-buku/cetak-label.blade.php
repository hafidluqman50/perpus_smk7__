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
		h4 {
  			font-family: "Times New Roman", Times, serif;
		}
		.row {
			margin-top:5%;
		}
		.layout-label {
			width:10.3cm;
			height:5cm;
			border: 1px solid black;
			margin-left:auto;
			margin-right: auto;
			margin-bottom:5%;
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
			background-size:4.5cm 4.5cm;
			filter: grayscale(100%);
			opacity: 0.3;
		}
		.label-header {
			width: 100%;
			height:1.7cm;
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
								<h4 align="center" style="margin-top:1%;"><b>PERPUSTAKAAN</b></h4>
								<h4 align="center" style="margin-bottom:2%;"><b>SMK NEGERI 7 SAMARINDA</b></h4>
							</div>
							<div class="label-body">
								<h4 align="center" style="margin-top:1%;"><b>{{ $value->klasifikasi }}</b></h4>
								<h4 align="center"><b>{{ $value->sn_penulis }}</b></h4>
								<h4 align="center"><b>{{ $value->inisial_buku }}</b></nav></h4>
							</div>
						</div>
						<h5 align="center">{{ $value->judul_buku }}</h5>
					</div>
				@if ($count % 2 == 1)
				</div>
				@endif
				@php 
					$count = $count + 1;
				@endphp
				@if ($count % 10 == 0)
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