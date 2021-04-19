<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaranModel as TahunAjaran;
use App\Models\KelasTingkatModel as KelasTingkat;
use App\Models\JurusanModel as Jurusan;
use App\Models\TransaksiModel as Transaksi;
use App\Models\PetugasModel as Petugas;
use App\Models\SuratBebasPustakaModel as SuratBebasPustaka;
use Illuminate\Http\Request;

class PrintBebasPustakaController extends Controller
{
    public function index()
    {
		$title         = 'Print Bebas Pustaka | Admin';
		$page          = 'print-bebas-pustaka';
		$buku          = 'menu-open';
		$tahun_ajaran  = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();
		$kelas_tingkat = KelasTingkat::whereNotIn('kelas_tingkat',['-'])->get();
		$jurusan       = Jurusan::whereNotIn('nama_jurusan',['-'])->get();

    	return view('Pengurus.Admin.page.buku.print-bebas-pustaka.main',compact('title','page','buku','tahun_ajaran','kelas_tingkat','jurusan'));
    }

    public function cetakSurat(Request $request)
    {
		$tahun_ajaran  = $request->tahun_ajaran;
		$kelas_tingkat = $request->kelas_tingkat;
		$jurusan       = $request->jurusan;

		$get_siswa = Transaksi::join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                    ->join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                    ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                    ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
                    ->where('tipe_anggota','siswa')
                    ->where('anggota_perpus.id_tahun_ajaran',$tahun_ajaran)
                    ->where('kelas.id_kelas_tingkat',$kelas_tingkat)
                    ->where('kelas.id_jurusan',$jurusan)
                    ->get();

		$nomor_surat   = SuratBebasPustaka::getNomorSurat($tahun_ajaran);
		$kepala_perpus = Petugas::where('jabatan','kepala-perpustakaan')->firstOrFail();

        return view('Pengurus.Admin.page.buku.print-bebas-pustaka.bebas-pustaka',compact('get_siswa','nomor_surat','kepala_perpus'));
    }
}
