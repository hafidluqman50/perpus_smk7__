<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/tes','ngeteh');

Route::get('/test-export','Admin\TransaksiController@cobaExport');

Route::get('/notifications/{pesan}',function($pesan){
	$users = User::all();
	foreach ($users as $user) {
		$user->notify(new RatingBuku($pesan));
	}
});

Route::get('/testing/{param1}/{param2}',function($param1,$param2){
	echo 'Jumlah Stok Box Ialah '.stokBox($param1,$param2);
});

// Route::get('')

Route::get('/strlen',function(){
	echo strlen('PENCARIAN HEURISTIC');
});

Route::get('/coba',function(){
	// dd(Buku::cekRating());
	dd(Auth::check());
});

Route::get('/send/email',function(){
	// $coba = Mail::to($to)->send(new App\Mail\NotifPinjam);
	// return $coba;
	$data = ['sip' => 'Oke'];
	Mail::to('hafidluqmanulhakim@gmail.com')->send(new App\Mail\NotifPinjam($data));
	return response('Berhasil');
});

Route::view('oke','ngeteh');

Route::post('/ngeteh',function(Request $request){
	// dd($request);
	// $mantap = $request->mantap;
	// dd($mantap);
});


// Route::get('/str-len',function(){
// 	echo strlen('Bahasa Indonesia K-13');
// });

Route::get('/','Home\HomeController@home');
Route::get('/buku',['as'=>'buku-page','uses'=>'Home\BukuController@buku']);
Route::get('/buku/{slug}',['as'=>'buku-detail-page','uses'=>'Home\BukuController@detailBuku']);
Route::get('/kategori/{slug}',['as'=>'kategori-page','uses'=>'Home\KategoriController@kategori']);
Route::get('/kategori/{slug}/sub-kategori/{slug_sub}',['as'=>'sub-kategori-page','uses'=>'Home\KategoriController@subKategori']);

// Route::group(['middleware'=>'isLogin'],function(){
	Route::get('/login-form','AuthController@FormLogin');
	Route::post('/login/auth',['as'=>'login-post','uses'=>'AuthController@login']);
// });
Route::get('/logout',['as'=>'logout','uses'=>'AuthController@logout']);

Route::group(['prefix'=>'datatables'],function(){
	Route::get('/tahun-ajaran',['as'=>'tahun-ajaran-datatables','uses'=>'AjaxController@dataTahunAjaran']);
	Route::get('/data-buku-tamu',['as'=>'data-buku-tamu-datatables','uses'=>'AjaxController@dataBukuTamu']);
	Route::get('/data-anggota/{tipe_anggota}',['as'=>'data-anggota-datatables','uses'=>'AjaxController@dataAnggota']);
	Route::get('/kelas',['as'=>'kelas-siswa-datatables','uses'=>'AjaxController@dataKelas']);
	Route::get('/kelas/detail/{id}',['as'=>'kelas-detail-datatables','uses'=>'AjaxController@dataKelasDetail']);
	Route::get('/data-buku',['as'=>'data-buku-datatables','uses'=>'AjaxController@dataBuku']);
	Route::get('/data-buku-rusak',['as'=>'data-buku-datatables','uses'=>'AjaxController@dataBukuRusak']);
	Route::get('/data-kategori',['as'=>'data-kategori-datatables','uses'=>'AjaxController@dataKategori']);
	Route::get('/data-sub-kategori/{id_ktg}',['as'=>'data-kategori-datatables','uses'=>'AjaxController@dataSubKategori']);
	Route::get('/data-barcode',['as'=>'data-barcode-datatables','uses'=>'AjaxController@dataBarcode']);
	Route::get('/data-surat-bebas-pustaka',['as'=>'data-buku-tamu-datatables','uses'=>'AjaxController@dataSuratBebasPustaka']);
	Route::get('/data-transaksi/{jenis}',['as'=>'data-transaksi-datatables','uses'=>'AjaxController@dataTransaksi']);
	Route::get('/data-detail-transaksi/{id}/{jenis}',['as'=>'data-detail-datatables','uses'=>'AjaxController@dataDetailTransaksi']);
	// Route::get('/coba','AjaxController@coba');
	// Route::get('/telegram','AjaxController@getUpdates');
});

Route::group(['prefix'=>'ajax'],function(){
	Route::get('/get-sub/{id}',['as'=>'ajax-get-sub','uses'=>'AjaxController@getSubKategori']);
	Route::get('/get-buku/{id}',['as'=>'ajax-get-buku','uses'=>'AjaxController@getBuku']);
	Route::get('/get-buku-barcode/{barcode}',['as'=>'ajax-buku-barcode','uses'=>'AjaxController@getBukuBarcode']);
	Route::get('/get-siswa/{id_tahun_ajaran}/{id_kelas}',['as'=>'ajax-get-siswa','uses'=>'AjaxController@getSiswa']);
	Route::get('/cari-buku/{judul}/{order}',['as'=>'ajax-cari-buku','uses'=>'AjaxController@cariBuku']);
	Route::get('/order-buku/{order}',['as'=>'ajax-order-buku','uses'=>'AjaxController@orderBuku']);
	Route::get('/order-buku/{order}/{judul}',['as'=>'ajax-order-buku','uses'=>'AjaxController@orderBuku']);
	Route::get('/buku-wishlist/{id_buku}/{id_anggota}',['as'=>'ajax-buku-wishlist','uses'=>'AjaxController@wishlistBuku']);
});

Route::group(['middleware'=>'isAnggota'],function(){
	Route::get('/profile',['as'=>'profile-page','uses'=>'Home\HomeController@profile']);
	Route::get('/ubah/profile',['as'=>'settings-page','uses'=>'Home\HomeController@settings']);
	Route::post('/ubah/profile/save',['as'=>'settings-post','uses'=>'Home\HomeController@saveSettings']);
	Route::group(['middleware'=>'checkPinjam'],function(){
		Route::get('/pinjam/buku/{slug}',['as'=>'buku-pinjam-page','uses'=>'Home\PinjamController@pinjam']);
		Route::post('/pinjam/save',['as'=>'pinjam-post','uses'=>'Home\PinjamController@pinjamPost']);
	});
	Route::get('/pinjam/buku/detail/{id}',['as'=>'pinjam-detail-page','uses'=>'Home\PinjamController@detailPinjam']);
	Route::post('/pinjam/batal',['as'=>'pinjam-batal-proses','uses'=>'Home\PinjamController@pinjamBatal']);
});

Route::group(['prefix'=>'admin','middleware'=>'isAdmin'],function(){
	Route::get('/dashboard',['as'=>'admin-dashboard-page','uses'=>'Admin\DashboardController@dashboard']);

	 // BUKU TAMU //
	Route::get('/data-buku-tamu',['as' => 'admin-data-buku-tamu','uses'=>'Admin\BukuTamuController@index']);
	Route::get('/data-buku-tamu/delete/{id}',['as' => 'admin-data-buku-tamu','uses'=>'Admin\BukuTamuController@delete']);
	Route::get('/buku-tamu',['as' => 'admin-data-buku-tamu','uses'=>'Admin\BukuTamuController@bukuTamu']);
	Route::post('/buku-tamu/save',['as' => 'admin-data-buku-tamu','uses'=>'Admin\BukuTamuController@save']);
	Route::get('/data-buku-tamu/export',['as' => 'admin-buku-tamu-export','uses' => 'Admin\BukuTamuController@rekapPengunjung']);
	// END BUKU TAMU //

	// CRUD TAHUN AJARAN //
	Route::get('/tahun-ajaran',['as'=>'admin-tahun-ajaran','uses'=>'Admin\TahunAjaranController@index']);
	Route::get('/tahun-ajaran/tambah',['as'=>'admin-tahun-ajaran','uses'=>'Admin\TahunAjaranController@tambah']);
	Route::get('/tahun-ajaran/edit/{id}',['as'=>'admin-tahun-ajaran','uses'=>'Admin\TahunAjaranController@edit']);
	Route::post('/tahun-ajaran/save',['as'=>'admin-tahun-ajaran-save','uses'=>'Admin\TahunAjaranController@save']);
	Route::get('/tahun-ajaran/delete/{id}',['as'=>'admin-tahun-ajaran','uses'=>'Admin\TahunAjaranController@delete']);
	Route::get('/tahun-ajaran/status-tahun/{id}',['as'=>'admin-tahun-ajaran','uses'=>'Admin\TahunAjaranController@statusTahun']);
	// END CRUD TAHUN AJARAN //

	// CRUD ANGGOTA //
	Route::get('/data-anggota/siswa',['as'=>'admin-data-siswa','uses'=>'Admin\AnggotaController@siswa']);
	Route::get('/data-anggota/siswa/tambah',['as'=>'admin-data-siswa','uses'=>'Admin\AnggotaController@tambahSiswa']);
	Route::get('/data-anggota/guru',['as'=>'admin-data-guru','uses'=>'Admin\AnggotaController@guru']);
	Route::get('/data-anggota/guru/tambah',['as'=>'admin-tambah-guru','uses'=>'Admin\AnggotaController@tambahGuru']);
	Route::get('/data-anggota/siswa/edit/{id}',['as'=>'admin-edit-siswa','uses'=>'Admin\AnggotaController@editSiswa']);
	Route::get('/data-anggota/guru/edit/{id}',['as'=>'admin-edit-anggota','uses'=>'Admin\AnggotaController@editGuru']);
	Route::get('/data-anggota/delete/{id}',['as'=>'admin-delete-anggota','uses'=>'Admin\AnggotaController@deleteAnggota']);
	Route::get('/status-anggota/{id}',['as'=>'admin-status-anggota','uses'=>'Admin\AnggotaController@statusAnggota']);
	Route::post('/data-anggota/save',['as'=>'admin-data-siswa','uses'=>'Admin\AnggotaController@saveAnggota']);

	Route::get('/kelas',['as'=>'admin-kelas-siswa','uses'=>'Admin\KelasController@index']);
	Route::get('/kelas/tambah',['as'=>'admin-kelas-tambah','uses'=>'Admin\KelasController@tambah']);
	Route::get('/kelas/edit/{id}',['as'=>'admin-kelas-tambah','uses'=>'Admin\KelasController@edit']);
	Route::get('/kelas/delete/{id}',['as'=>'admin-kelas-tambah','uses'=>'Admin\KelasController@delete']);
	Route::post('/kelas/save',['as'=>'admin-kelas-save','uses'=>'Admin\KelasController@save']);

	Route::get('/kelas/detail/{id}',['as'=>'admin-kelas-detail','uses'=>'Admin\KelasController@detail']);
	Route::get('/kelas/detail/{id}/tambah',['as'=>'admin-kelas-detail','uses'=>'Admin\KelasController@tambahDetail']);
	Route::get('/kelas/detail/{id}/delete/{id_detail}',['as'=>'admin-kelas-detail','uses'=>'Admin\KelasController@deleteDetail']);
	Route::post('/kelas/detail/{id}/save',['as'=>'admin-kelas-detail','uses'=>'Admin\KelasController@saveDetail']);
	// END CRUD ANGGOTA //

	// CRUD BARCODE //
	Route::get('/barcode-buku',['as'=>'admin-barcode-buku','uses'=>'Admin\BarcodeController@index']);
	Route::get('/barcode-buku/tambah',['as'=>'admin-barcode-buku','uses'=>'Admin\BarcodeController@tambah']);
	Route::get('/barcode-buku/edit/{id}',['as'=>'admin-barcode-buku','uses'=>'Admin\BarcodeController@edit']);
	Route::get('/barcode-buku/delete/{id}',['as'=>'admin-barcode-buku','uses'=>'Admin\BarcodeController@delete']);
	Route::post('/barcode-buku/save',['as'=>'admin-barcode-buku','uses'=>'Admin\BarcodeController@save']);
	// END CRUD BARCODE //

	// CRUD BUKU //
	Route::get('/data-buku',['as'=>'admin-data-buku','uses'=>'Admin\BukuController@index']);
	Route::get('/data-buku/tambah',['as'=>'admin-buku-tambah','uses'=>'Admin\BukuController@tambah']);
	Route::get('/data-buku/edit/{id}',['as'=>'admin-buku-edit','uses'=>'Admin\BukuController@edit']);
	Route::get('/data-buku/delete/{id}',['as'=>'admin-buku-delete','uses'=>'Admin\BukuController@delete']);
	Route::get('/data-buku/import',['as'=>'admin-buku-import','uses'=>'Admin\BukuController@importBuku']);
	Route::get('/data-buku/cetak',['as'=>'admin-buku-cetak','uses'=>'Admin\BukuController@cetakLaporan']);
	Route::post('/data-buku/save',['as'=>'admin-buku-save','uses'=>'Admin\BukuController@save']);
	Route::post('/data-buku/import/post',['as'=>'admin-import-save','uses'=>'Admin\BukuController@importPost']);
	// END CRUD BUKU //

	// CRUD BUKU //
	Route::get('/data-buku-rusak',['as'=>'admin-data-buku-rusak','uses'=>'Admin\BukuRusakController@index']);
	Route::get('/data-buku-rusak/tambah',['as'=>'admin-buku-rusak-tambah','uses'=>'Admin\BukuRusakController@tambah']);
	Route::get('/data-buku-rusak/edit/{id}',['as'=>'admin-buku-rusak-edit','uses'=>'Admin\BukuRusakController@edit']);
	Route::get('/data-buku-rusak/delete/{id}',['as'=>'admin-buku-rusak-delete','uses'=>'Admin\BukuRusakController@delete']);
	Route::post('/data-buku-rusak/save',['as'=>'admin-buku-rusak-save','uses'=>'Admin\BukuRusakController@save']);
	// END CRUD BUKU //

	// CRUD KATEGORI //
	Route::get('/kategori-buku',['as'=>'admin-data-kategori','uses'=>'Admin\KategoriController@kategori']);
	Route::get('/kategori-buku/tambah',['as'=>'admin-kategori-tambah','uses'=>'Admin\KategoriController@tambahKategori']);
	Route::get('/kategori-buku/edit/{id}',['as'=>'admin-kategori-tambah','uses'=>'Admin\KategoriController@editKategori']);
	Route::get('/kategori-buku/delete/{id}',['as'=>'admin-kategori-tambah','uses'=>'Admin\KategoriController@deleteKategori']);
	Route::post('/kategori/save',['as'=>'admin-kategori-tambah','uses'=>'Admin\KategoriController@saveKategori']);

	Route::get('/sub-kategori/{id}',['as'=>'admin-sub-kategori','uses'=>'Admin\KategoriController@subKategori']);
	Route::get('/sub-kategori/tambah/{id}',['as'=>'admin-sub-kategori','uses'=>'Admin\KategoriController@tambahSubKategori']);
	Route::get('/sub-kategori/edit/{id,id_sub}',['as'=>'admin-sub-kategori','uses'=>'Admin\KategoriController@editSubKategori']);
	Route::get('/sub-kategori/delete/{id,id_sub}',['as'=>'admin-sub-kategori','uses'=>'Admin\KategoriController@deleteSubKategori']);
	Route::post('/sub-kategori/save',['as'=>'admin-sub-kategori','uses'=>'Admin\KategoriController@saveSubKategori']);
	// END CRUD KATEGORI //

	// CRUD SURAT BEBAS PUSTAKA //
	Route::get('/surat-bebas-pustaka',['as'=>'admin-bebas-pustaka', 'uses'=>'Admin\SuratBebasPustakaController@index']);
	Route::get('/surat-bebas-pustaka/tambah',['as'=>'admin-bebas-pustaka', 'uses'=>'Admin\SuratBebasPustakaController@tambah']);
	Route::get('/surat-bebas-pustaka/edit/{id}',['as'=>'admin-bebas-pustaka', 'uses'=>'Admin\SuratBebasPustakaController@edit']);
	Route::get('/surat-bebas-pustaka/delete/{id}',['as'=>'admin-bebas-pustaka', 'uses'=>'Admin\SuratBebasPustakaController@delete']);
	Route::post('/surat-bebas-pustaka/save',['as'=>'admin-bebas-pustaka', 'uses'=>'Admin\SuratBebasPustakaController@save']);
	// END CRUD SURAT BEBAS PUSTAKA //

	// CRUD TRANSAKSI //
	Route::get('/transaksi-buku/siswa',['as'=>'admin-transaksi-siswa','uses'=>'Admin\TransaksiController@transaksiSiswa']);
	Route::get('/transaksi-buku/detail-transaksi/siswa/{id}/konfirmasi/{id_detail_transaksi}',['as'=>'admin-konfirmasi-transaksi-siswa','uses'=>'Admin\TransaksiController@konfirmasiPinjamSiswa']);
	Route::get('/transaksi-buku/siswa/pinjam',['as'=>'admin-pinjam-siswa','uses'=>'Admin\TransaksiController@pinjamSiswa']);
	Route::get('/transaksi-buku/siswa/kembali',['as'=>'admin-kembali-siswa','uses'=>'Admin\TransaksiController@kembaliSiswa']);
	Route::get('/transaksi-buku/siswa/cetak',['as' => 'admin-cetak-transaksi-siswa','uses'=>'Admin\TransaksiController@cetakTransaksi']);

	Route::get('/transaksi-buku/guru',['as'=>'admin-transaksi-guru','uses'=>'Admin\TransaksiController@transaksiGuru']);
	Route::get('/transaksi-buku/guru/pinjam',['as'=>'admin-pinjam-guru','uses'=>'Admin\TransaksiController@pinjamGuru']);
	Route::get('/transaksi-buku/guru/konfirmasi/{id_detail_transaksi}',['as'=>'admin-konfirmasi-transaksi-guru','uses'=>'Admin\TransaksiController@konfirmasiPinjamGuru']);
	Route::get('/transaksi-buku/guru/kembali',['as'=>'admin-kembali-guru','uses'=>'Admin\TransaksiController@kembaliGuru']);

	Route::get('/transaksi-buku/delete/{id}',['as' => 'admin-delete-transaksi-buku', 'uses' => 'Admin\TransaksiController@deleteTransaksi']);
	Route::post('/transaksi-buku/pinjam/post',['as'=>'admin-pinjam-post','uses'=>'Admin\TransaksiController@pinjamPost']);
	Route::post('/transaksi-buku/kembali/post',['as'=>'admin-kembali-post','uses'=>'Admin\TransaksiController@kembaliPost']);
	Route::post('/transaksi-buku/detail-transaksi/konfirmasi-post',['as'=>'admin-konfirmasi-transaksi','uses'=>'Admin\TransaksiController@konfirmasiTransaksi']);
	Route::get('/transaksi-buku/detail-transaksi/siswa/{id}',['as'=>'admin-detail-siswa','uses'=>'Admin\TransaksiController@detailTransaksiSiswa']);
	Route::get('/transaksi-buku/detail-transaksi/guru/{id}',['as'=>'admin-detail-guru','uses'=>'Admin\TransaksiController@detailTransaksiGuru']);
	Route::get('/transaksi-buku/detail-transaksi/{id}/delete/{id_detail}',['as'=>'admin-detail-siswa','uses'=>'Admin\TransaksiController@deleteDetailTransaksi']);

	Route::get('/transaksi-buku/cetak-laporan-buku',['as'=>'admin-cetak-laporan','uses'=>'Admin\TransaksiController@cetakTransaksi']);

	Route::get('/transaksi-buku/siswa/cetak-bebas-pustaka/{id}',['as'=>'admin-bebas-pustaka','uses'=>'Admin\TransaksiController@bebasPustaka']);
	// END CRUD TRANSAKSI //

	// CRUD PETUGAS //
	Route::get('/data-petugas',['as'=>'admin-data-petugas','uses'=>'Admin\PetugasController@index']);
	Route::get('/data-petugas/tambah',['as'=>'admin-petugas-tambah','uses'=>'Admin\PetugasController@tambah']);
	Route::get('/data-petugas/edit/{id}',['as'=>'admin-petugas-edit','uses'=>'Admin\PetugasController@edit']);
	Route::get('/status-petugas/{id}',['as'=>'admin-petugas-status','uses'=>'Admin\PetugasController@statusPetugas']);
	Route::get('/data-petugas/delete/{id}',['as'=>'admin-petugas-delete','uses'=>'Admin\PetugasController@delete']);
	Route::post('/data-petugas/save',['as'=>'admin-petugas-save','uses'=>'Admin\PetugasController@save']);
	// END CRUD PETUGAS //
});

Route::group(['prefix'=>'petugas','middleware'=>'isPetugas'],function(){
	Route::get('/dashboard',['as'=>'petugas-dashboard-page','uses'=>'Petugas\DashboardController@dashboard']);
});
