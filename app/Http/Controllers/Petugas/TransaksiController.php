<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransaksiModel as Transaksi;
use App\Models\TransaksiDetailModel as TransaksiDetail;
use App\Models\KategoriModel as Kategori;
use App\Models\TahunAjaranModel as TahunAjaran;
use App\Models\BarcodeModel as Barcode;
use App\Models\TipeAnggotaModel as TipeAnggota;
use App\Models\BukuModel as Buku;
use App\Models\AnggotaModel as Anggota;
use App\Models\AnggotaPerpusModel as AnggotaPerpus;
use App\Models\KelasModel as Kelas;
use App\Models\SuratBebasPustakaModel as SuratBebasPustaka;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Session;
use DB;

class TransaksiController extends Controller
{
    public function transaksiSiswa() 
    {
        $title        = 'Transaksi Buku Siswa | Petugas';
        $page         = 'transaksi-buku-siswa';
        $buku         = 'menu-open';
        $tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();

        return view('Pengurus.Petugas.page.buku.transaksi-buku.main-siswa',compact('title','page','buku','tahun_ajaran'));
    }

    public function transaksiGuru() 
    {
        $title = 'Transaksi Buku Guru | Petugas';
        $page  = 'transaksi-buku-guru';
        $buku  = 'menu-open';
        $type  = 'guru';
        return view('Pengurus.Petugas.page.buku.transaksi-buku.main-guru',compact('title','page','buku','type'));   
    }

    public function pinjamSiswa() 
    {
        $title        = 'Form Pinjam Siswa | Petugas';
        $page         = 'transaksi-buku-siswa';
        $buku         = 'menu-open';
        $tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();
        $kelas        = Kelas::showKelasSiswa();
        $data_buku    = Buku::all();
        return view('Pengurus.Petugas.page.buku.transaksi-buku.form-pinjam-siswa',compact('title','page','buku','data_buku','tahun_ajaran','kelas'));
    }

    public function pinjamGuru() 
    {
        $title    = 'Form Pinjam Guru | Petugas';
        $page     = 'transaksi-buku-guru';
        $buku     = 'menu-open';
        $guru     = AnggotaPerpus::getGuru();
        return view('Pengurus.Petugas.page.buku.transaksi-buku.form-pinjam-guru',compact('title','page','buku','guru'));
    }

    public function detailTransaksiSiswa($id) 
    {
        $title = 'Transaksi Detail | Petugas';
        $page  = 'transaksi-buku-siswa';
        $buku  = 'menu-open';
        $siswa = Transaksi::siswaTrans($id);
        return view('Pengurus.Petugas.page.buku.transaksi-buku.main-siswa-detail',compact('title','page','buku','id','siswa'));
    }

    public function detailTransaksiGuru($id) 
    {
        $title = 'Transaksi Detail Guru | Petugas';
        $page  = 'transaksi-buku-guru';
        $buku  = 'menu-open';
        return view('Pengurus.Petugas.page.buku.transaksi-buku.main-guru-detail',compact('title','page','buku','id'));
    }

    public function deleteTransaksi($id) 
    {
        $tipe_anggota = Transaksi::getTipeAnggotaById($id);
        Transaksi::where('id_transaksi',$id)->delete();

        return redirect('/petugas/transaksi-buku/'.$tipe_anggota)->with('message','Berhasil Hapus Data');
    }

    public function deleteDetailTransaksi($id,$id_detail) 
    {
        $tipe_anggota = TransaksiDetail::getRowDetail($id,$id_detail)->tipe_anggota;
        TransaksiDetail::where('id_transaksi',$id)
                        ->where('id_detail_transaksi',$id_detail)
                        ->delete();

        $message[0] = ['class'=>'alert-success','text'=>'Berhasil Hapus Detail Transaksi'];
        return redirect('/petugas/transaksi-buku/detail-transaksi/'.$tipe_anggota.'/'.$id)->with('message',$message);
    }

    public function konfirmasiPinjamSiswa($id,$id_detail)
    {
        $title      = 'Konfirmasi Pinjam Siswa';
        $page       = 'transaksi-buku-siswa';
        $buku       = 'menu-open';
        $konfirmasi = TransaksiDetail::getRowKonfirmasi($id,$id_detail);

        return view('Pengurus.Petugas.page.buku.transaksi-buku.form-konfirmasi-siswa',compact('title','konfirmasi','id','id_detail','page','buku'));
    }

    public function konfirmasiTransaksi(Request $request) 
    {
        $id_transaksi        = $request->id_transaksi;
        $id_detail_transaksi = $request->id_detail_transaksi;
        $tipe                = $request->tipe;
        $barcode             = $request->barcode;

        $get_barcode = Barcode::where('code_scanner',$barcode)->firstOrFail();

        TransaksiDetail::where('id_transaksi',$id_transaksi)
                        ->where('id_detail_transaksi',$id_detail_transaksi)
                        ->update([
                            'kode_buku'        => $get_barcode->kode_buku,
                            'status_transaksi' => 'sedang-dipinjam',
                        ]);

        $message = [['class' => 'alert-success','text' => 'Berhasil Konfirmasi']];

        return redirect('/petugas/transaksi-buku/detail-transaksi/'.$tipe.'/'.$id_transaksi)->with('message',$message);
    }

    public function kembaliSiswa() 
    {
        $title = 'Form Kembali Siswa | Petugas';
        $page = 'transaksi-buku-siswa';
        $buku = 'menu-open';
        $tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();
        $kelas        = Kelas::showKelasSiswa();
        return view('Pengurus.Petugas.page.buku.transaksi-buku.form-kembali-siswa',compact('title','page','buku','tahun_ajaran','kelas'));
    }

    public function kembaliGuru() 
    {
        $title = 'Form Kembali Guru | Petugas';
        $page = 'transaksi-buku-guru';
        $buku = 'menu-open';
        return view('Pengurus.Petugas.page.buku.transaksi-buku.form-kembali-guru',compact('title','page','buku'));
    }

    public function pinjamPost(Request $request) 
    {
        $anggota               = $request->anggota;
        $buku_barcode          = $request->buku_barcode;
        $buku_manual           = $request->buku_manual;
        $stok_pinjam           = 1;
        $tanggal_pinjam        = date('Y-m-d');
        $tanggal_harus_kembali = dua_minggu(date('Y-m-d'));
        $tipe                  = $request->tipe;
        $message               = [];
        if (Transaksi::where('id_anggota_perpus',$anggota)->count() == 0) {
            $getId = Transaksi::insertGetId(['id_anggota_perpus'=>$anggota]);
        }
        else {
            $getId = Transaksi::where('id_anggota_perpus',$anggota)->firstOrFail()->id_transaksi;
        }

        if ($buku_barcode != null || $buku_barcode != '') {
            foreach ($buku_barcode as $key => $value) {

                $get_buku    = Barcode::getBuku($value);
                $count       = TransaksiDetail::where('kode_buku',$value)->where('status_transaksi','sedang-dipinjam')->count();
                $cek_ktg     = TransaksiDetail::cekKtg($anggota,$get_buku->id_kategori_buku);
                $get_anggota = $anggota;

                if ($count == 0 && $cek_ktg == true) {
                    $cek_stok = Buku::where('id_buku',$get_buku->id_buku)->firstOrFail()->stok_buku;
                    if ($cek_stok > 0) {
                        $pinjam[] = [
                            'id_transaksi'          => $getId,
                            'id_buku'               => $get_buku->id_buku,
                            'kode_buku'             => $value,
                            'stok_transaksi'        => $stok_pinjam,
                            'tanggal_pinjam'        => $tanggal_pinjam,
                            'tanggal_harus_kembali' => $tanggal_harus_kembali,
                            'status_transaksi'      => 'sedang-dipinjam'
                        ];
                        $flash = ['class'=>'alert-success','text'=>'Buku <b>'.$get_buku->judul_buku.'</b> Berhasil Dipinjam'];
                    }
                    else {
                        $flash = ['class'=>'alert-danger','text'=>'Stok Buku <b>'.$get_buku->judul_buku.'</b> Telah Habis'];
                    }
                }
                elseif ($count == 0 && $cek_ktg == false) {
                    $get_buku_pinjam = TransaksiDetail::showBukuPinjam($anggota);
                    $flash = ['class'=>'alert-danger','text'=>'Anggota <b>'.ucwords($get_buku_pinjam->tipe_anggota).' '.$get_buku_pinjam->nama_anggota.'</b> Sedang meminjam buku <b>'.$get_buku_pinjam->judul_buku.'</b> Harap dikembalikan terlebih dahulu untuk meminjam buku lain'];
                }
                else {
                    $get_peminjam = TransaksiDetail::peminjam($value);
                    $kelas        = $get_peminjam->tipe_anggota == 'siswa' ? ' Kelas '.$get_peminjam->ket.' ' : '';
                    $tahun_ajaran = $get_peminjam->tipe_anggota == 'siswa' ? ' Tahun Ajaran '.$get_peminjam->tahun_ajaran.' ' : '';
                    $flash = ['class'=>'alert-warning','text'=>'Buku <b>'.$id_buku->judul_buku.'</b> Sedang Dipinjam Oleh <b>'.ucwords($get_peminjam->tipe_anggota).' '.$get_peminjam->nama_anggota.$kelas.$tahun_ajaran.'</b>'];
                }
                array_push($message,$flash);
            }
        }

        elseif ($buku_manual != null || $buku_manual != '') {
            foreach ($buku_manual as $key => $value) {
                // $count           = TransaksiDetail::where('kode_buku',$value)->where('status_transaksi','sedang-dipinjam')->count();
                $get_buku        = Buku::where('id_buku',$value)->firstOrFail();
                $cek_ktg         = TransaksiDetail::cekKtg($anggota,$get_buku->id_kategori_buku);
                $get_anggota     = $anggota;

                if ($cek_ktg == true) {
                    $cek_stok = Buku::where('id_buku',$get_buku->id_buku)->firstOrFail()->stok_buku;
                    if ($cek_stok > 0) {
                        $pinjam[] = [
                            'id_transaksi'          => $getId,
                            'id_buku'               => $value,
                            'kode_buku'             => '',
                            'stok_transaksi'        => $stok_pinjam,
                            'tanggal_pinjam'        => $tanggal_pinjam,
                            'tanggal_harus_kembali' => $tanggal_harus_kembali,
                            'status_transaksi'      => 'sedang-dipinjam'
                        ];
                        $flash = ['class'=>'alert-success','text'=>'Buku <b>'.$get_buku->judul_buku.'</b> Berhasil Dipinjam'];
                    }
                    else {
                        $flash = ['class'=>'alert-danger','text'=>'Stok Buku <b>'.$get_buku->judul_buku.'</b> Telah Habis'];
                    }
                }
                elseif ($cek_ktg == false) {
                    $get_buku_pinjam = TransaksiDetail::showBukuPinjam($anggota);
                    $flash = ['class'=>'alert-danger','text'=>'Anggota <b>'.ucwords($get_buku_pinjam->tipe_anggota).' '.$get_buku_pinjam->nama_anggota.'</b> Sedang meminjam buku <b>'.$get_buku_pinjam->judul_buku.'</b> Harap dikembalikan terlebih dahulu untuk meminjam buku lain'];
                }
                array_push($message,$flash);
            }
        }

        if (isset($pinjam)) {
            TransaksiDetail::insert($pinjam);
        }
        
        return redirect('/petugas/transaksi-buku/detail-transaksi/'.$tipe.'/'.$getId)->with('message',$message);
    }

    public function kembaliPost(Request $request) 
    {
        $anggota = $request->anggota;
        $buku    = $request->buku;
        $tipe    = $request->tipe;
        $message = [];

        $id_transaksi = Transaksi::where('id_anggota_perpus',$anggota)
                                ->firstOrFail()->id_transaksi;

        foreach ($buku as $key => $value) {
            $barcode     = Barcode::where('kode_buku',$value)->firstOrFail();
            $buku_pinjam = TransaksiDetail::checkBuku($anggota,$barcode->kode_buku,$barcode->id_buku);
            $buku        = Buku::where('id_buku',$barcode->id_buku)->firstOrFail();

            if ($buku_pinjam) {
                TransaksiDetail::where('id_transaksi',$id_transaksi)->where('id_buku',$barcode->id_buku)->update(['status_transaksi'=>'kembali','tanggal_kembali'=>date('Y-m-d')]);

                $text = 'Berhasil Kembalikan Buku '.$buku->judul_buku;

                $flash[$key] = ['class' => 'alert-success','text' => $text];
            }
            else {
                $id_anggota_perpus = TransaksiDetail::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')->where('kode_buku',$barcode->kode_buku)->firstOrFail();

                $anggota_perpus = AnggotaPerpus::join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
                        ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                        ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                        ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                        ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
                        ->where('id_anggota_perpus',$id_anggota_perpus->id_anggota_perpus)
                        ->firstOrFail();

                TransaksiDetail::where('id_buku',$barcode->id_buku)
                                ->where('kode_buku',$barcode->kode_buku)
                                ->update(['status_transaksi'=>'kembali','tanggal_kembali'=>date('Y-m-d'),'keterangan'=>'Tertukar']);

                TransaksiDetail::where('id_transaksi',$id_transaksi)->where('id_buku',$barcode->id_buku)->update(['keterangan'=>'Tertukar']);

                if ($anggota_perpus->tipe_anggota == 'guru') {
                    $text = 'Buku '.$buku->judul_buku.' Tertukar dan telah kembali ke Guru '.$anggota_perpus->nama_anggota;
                }
                else {
                    $text = 'Buku <b>'.$buku->judul_buku.'</b> Tertukar dan telah kembali ke Siswa <b>'.$anggota_perpus->nama_anggota.' Kelas '.$anggota_perpus->kelas_tingkat.' '.$anggota_perpus->nama_jurusan.' '.$anggota_perpus->urutan_kelas.'</b>';
                }

                $flash[$key] = ['class' => 'alert-danger', 'text' => $text];
            }
        }

        return redirect('/petugas/transaksi-buku/detail-transaksi/'.$tipe.'/'.$id_transaksi)->with('message',$flash);
    }

    public function bebasPustaka($id)
    {
        $siswa         = Transaksi::siswaTrans($id);
        $bebas_pustaka = new SuratBebasPustaka;

        return view('Pengurus.Petugas.page.buku.transaksi-buku.bebas-pustaka',compact('siswa','bebas_pustaka'));
    }

    public function perpanjang($id) 
    {
    	//
    }

    public function savePerpanjang(Request $request) 
    {
        //
    }
}
