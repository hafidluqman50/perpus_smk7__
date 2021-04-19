<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=, initial-scale=1.0">
	<title>Email</title>
</head>
<body>
	<h5>PENGINGAT KEMBALIKAN BUKU</h5>
	<p>Hai, {{ $nama_anggota }}</p>
	<p>Buku {{ $buku }} Harus Dikembalikan Tanggal {{ date_explode($tanggal_harus_kembali) }}</p>
	<p>Jangan Telat Loh</p>
	<p>Cek Halaman Profile untuk melihat list peminjaman</a></p>
</body>
</html>