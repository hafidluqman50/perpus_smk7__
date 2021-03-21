<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AnggotaModel as Anggota;
use App\Models\AnggotaPerpusModel as AnggotaPerpus;
use App\Models\TransaksiModel as Transaksi;
use App\Models\TransaksiDetailModel as TransaksiDetail;
use Auth;
use DB;

class PinjamController extends Controller
{
    public function pinjam($slug) {
        $title = 'Transaksi Buku';
        $buku  = DB::table('buku')
                  ->join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                  ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                  ->where('judul_slug',$slug)
                  ->first();
        $anggota = AnggotaPerpus::getRow(Auth::id());
        // dd($slug);
        return view('Main.page.transaksi-buku',compact('title','buku','anggota'));
    }

    public function pinjamPost(Request $request) {
        $buku                  = $request->id_buku;
        $tanggal_pinjam        = back_normal_date($request->tanggal_pinjam);
        $tanggal_harus_kembali = back_normal_date($request->tanggal_harus_kembali);
        $anggota               = $request->id_anggota;
        // dd($anggota);
        $status_transaksi      = $request->status_transaksi;

        $cek = Transaksi::where('id_anggota_perpus',$anggota);
        if ($cek->count() > 0) {
            $id_transaksi = $cek->firstOrFail()->id_transaksi;
        }
        else {
            $id_transaksi = Transaksi::insertGetId(['id_anggota'=>$anggota]);
        }

        $detail_transaksi = [
            'id_transaksi'          => $id_transaksi,
            'id_buku'               => $buku,
            'stok_transaksi'        => 0,
            'tanggal_pinjam'        => $tanggal_pinjam,
            'tanggal_harus_kembali' => $tanggal_harus_kembali,
            'status_transaksi'      => $status_transaksi
        ];
        $id_detail = TransaksiDetail::insertGetId($detail_transaksi);

        return redirect('/pinjam/buku/detail/'.$id_detail)->with('success','Berhasil Pinjam Buku');
    }

    public function detailPinjam($id) {
        $title             = 'Pinjam Detail | Perpus SMKN 7 Samarinda';
        $id_anggota_perpus = AnggotaPerpus::getRow(Auth::id())->id_anggota_perpus;
        $data              = TransaksiDetail::rowDetailPinjam($id,$id_anggota_perpus);

        return view('Main.page.pinjam-buku',compact('data','title','data'));
    }

    public function pinjamBatal(Request $request) {
        $id_anggota_perpus = $request->id_anggota_perpus;
        $id_detail         = $request->id_detail_transaksi;
        $status_transaksi  = 'batal-pinjam';

        $db = TransaksiDetail::join('transaksi_buku','detail_transaksi.id_transaksi','=','transaksi_buku.id_transaksi')
                                ->where('id_anggota_perpus',$id_anggota_perpus)
                                ->where('id_detail_transaksi',$id_detail)
                                ->update(['status_transaksi'=>$status_transaksi,
                                         'detail_transaksi.created_at'=>date('Y-m-d H:i:s'),
                                         'detail_transaksi.updated_at'=>date('Y-m-d H:i:s')
                                        ]);

        return redirect('/pinjam/buku/detail/'.$id_detail)->with('success','Berhasil Membatalkan Peminjaman');
    }
}
