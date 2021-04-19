<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Surat Bebas Pustaka</title>
	<style>
		* {
		    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari */
		    color-adjust: exact !important;                 /*Firefox*/
		}
		@page{
			size:a5;
			margin:0!important;
		}
		.layout {
			width:14.8cm;
			height:21cm;
			/*background-color: black;*/
			page-break-after: always;
		}
		.layout-header {
			width:100%;
			height:110px;
			background-image: url('/admin-assets/dist/img/kop_laporan.jpeg');
			background-size:cover;
		}
		.layout-body {
			width: 100%;
			min-height:100px;
			margin-left:25px;
			margin-right:25px;
		}
	</style>
</head>
<body>
	@foreach ($get_siswa as $siswa)

	<div class="layout">
		<div class="layout-header"></div>
		<div class="layout-body">
			<h5 style="margin-bottom:1px;" align="center"><b><u>SURAT KETERANGAN BEBAS PUSTAKA</u></b></h5>
			<p style="font-size:12px; margin:0;" align="center">Nomor : {{ $nomor_surat }}</p>
			<br>
			<p style="font-size:12px;">Perpustakaan SMK Negeri 7 Samarinda, menyatakan bahwa : </p>
			<br>
			<table style="font-size:12px;" width="100%">
				<tr>
					<td>NAMA</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp; : {{ $siswa->nama_anggota }}</td>
				</tr>
				<tr>
					<td>NISN</td>					
					<td>&nbsp;&nbsp;&nbsp;&nbsp; : {{ $siswa->nomor_induk }} </td>
				</tr>
				<tr>
					<td>KELAS</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp; : {{ $siswa->kelas_tingkat.' '.$siswa->nama_jurusan.' '.$siswa->urutan_kelas }} </td>
				</tr>
			</table>
			<br>
			<p style="font-size:12px;">Tidak mempunyai tanggungan peminjaman buku perpustakaan sehingga dinyatakan <b><u>Bebas Pustaka</u></b></p>
			<br>
			<p style="font-size:12px;">Demikian surat keterangan ini dibuat agar digunakan dengan sebagai mestinya.</p>
			<br>
			<div style="margin-left:60%;">
				<p style="font-size:12px;">Samarinda, {{ date_explode(date('Y-m-d')) }}</p>
				<br>
				<br>
				<br>
				<br>
				<p style="font-size:12px; margin-bottom:1px;"><b><u>{{$kepala_perpus->nama_petugas}}</u></b></p>
				<p style="font-size:12px; margin-top:0px;"><b>NIP.{{$kepala_perpus->nip}}</b></p>
			</div>
			<br>
			<br>
			{{-- <div> --}}
				<p style="font-size:12px;"><b>NB: digunakan sebagai syarat pengambilan rapor dan SKHU Sementara</b></p>
			{{-- </div> --}}
		</div>
	</div>
	@endforeach
</body>
</html>

<script>
	window.print();
</script>