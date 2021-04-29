<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaModel as Anggota;
use App\Models\AnggotaPerpusModel as AnggotaPerpus;
use App\Models\TahunAjaranModel as TahunAjaran;
use App\Models\KelasModel as Kelas;
use App\Models\PetugasModel as Petugas;
use App\Models\KategoriModel as Kategori;
use App\Models\SubKategoriModel as SubKategori;
use App\Models\BukuModel as Buku;
use App\Models\BukuTamuModel as BukuTamu;
use App\Models\BukuRusakModel as BukuRusak;
use App\Models\BarcodeModel as Barcode;
use App\Models\SuratBebasPustakaModel as SuratBebasPustaka;
use App\Models\TransaksiModel as Transaksi;
use App\Models\TransaksiDetailModel as TransaksiDetail;
use App\Models\AturanPinjamModel as AturanPinjam;
use App\Models\PanduanPinjamModel as PanduanPinjam;
use App\Models\PinBukuTamuModel as PinBukuTamu;
use Yajra\Datatables\Datatables;
use Telegram;
use Auth;
use Str;
use DB;

class AjaxController extends Controller
{
    private $level;

    function __construct()
    {
        $this->middleware(function($request,$next){
            // if (session('user')) {
            //     $this->level = session('user')->level_user == 4 ? 'siswa' : 'guru';
            // }
            // else {
            //     $this->level = Auth::user()->level_user == 4 ? 'admin' : 'pembimbing';
            // }
            if (Auth::user()->level == 2) {
                $this->level = 'admin';
            }
            else if (Auth::user()->level == 1) {
                $this->level = 'petugas';
            }
            return $next($request);
        });
    }

    public function dataTahunAjaran() 
    {
    	$tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->where('status_delete',0)->get();
    	$datatables = Datatables::of($tahun_ajaran)->addColumn('action',function($action){
        $array = [
    			0 => ['class'=>'btn-success','text'=>'Aktifkan'],
    			1 => ['class'=>'btn-danger','text'=>'Nonaktifkan']
    		];
    		$column = '<a href="'.url("/admin/tahun-ajaran/edit/$action->id_tahun_ajaran").'">
    					  <button class="btn btn-warning"> Edit </button>
					   </a>
					   <a href="'.url("/admin/tahun-ajaran/delete/$action->id_tahun_ajaran").'">
					   	   <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
					   </a>
    				';
                    
            // $column.='
            //             <a href="'.url("/admin/tahun-ajaran/status-tahun/$action->id_tahun_ajaran").'">
            //                 <button class="btn '.$array[$action->status_tahun]['class'].'">'.$array[$action->status_tahun]['text'].'</button>
            //            </a>';
    		return $column;
    	})->make(true);
    	return $datatables;
    }

    public function dataBukuTamu()
    {
        $buku_tamu = BukuTamu::getData();
        $datatables   = Datatables::of($buku_tamu)->addColumn('action',function($action){
            $column   = '
                       <a href="'.url("/admin/data-buku-tamu/delete/$action->id_buku_tamu").'">
                           <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
                       </a>';
            return $column;
        })->editColumn('tanggal_berkunjung',function($edit){
            return date_explode($edit->tanggal_berkunjung);
        })->editColumn('kelas_jabatan',function($edit){
            if ($edit->tipe_anggota == 'siswa') 
            {
                $data = $edit->kelas_tingkat.' '.$edit->nama_jurusan.' '.$edit->urutan_kelas;
            }
            else 
            {
                $data = ucwords($edit->tipe_anggota);
            }
            return $data;
        })->make(true);
        return $datatables;
    }

    public function dataAnggota(Request $request,$tipe_anggota) 
    {
        $anggota    = Anggota::showAnggota($tipe_anggota);
        $url        = $request->segment(3);
        $datatables = Datatables::of($anggota)->addColumn('action',function($action) use ($url){
    		$array = [
    			0 => ['class'=>'btn-success','text'=>'Aktifkan'],
    			1 => ['class'=>'btn-danger','text'=>'Nonaktifkan']
    		];
    		$column = '<a href="'.url("/admin/data-anggota/$url/edit/$action->id_anggota").'">
    					  <button class="btn btn-warning"> Edit </button>
					   </a>
					   <a href="'.url("/admin/data-anggota/delete/$action->id_anggota").'">
					   	   <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
					   </a>
					   <a href="'.url("/admin/status-anggota/$action->id_anggota").'">
					   		<button class="btn '.$array[$action->status_akun]['class'].'">'.$array[$action->status_akun]['text'].'</button>
					   </a>
    				';
    		return $column;
    	})->addColumn('status_anggota',function($status){
            $array = [
                0 => ['class'=>'badge badge-danger','text'=>'Non Aktif'],
                1 => ['class'=>'badge badge-success','text'=>'Aktif']
            ];
            return '<span class="'.$array[$status->status_akun]['class'].'">'.$array[$status->status_akun]['text'].'</span>';
        })->rawColumns(['status_anggota','action'])->make(true);
    	return $datatables;
    }

    public function dataKelas() 
    {
        $kelas        = Kelas::getData();
        $datatables   = Datatables::of($kelas)->addColumn('action',function($action){
            $column   = '<a href="'.url("/admin/kelas/edit/$action->id_kelas").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <a href="'.url("/admin/kelas/detail/$action->id_kelas").'">
                            <button class="btn btn-info"> Detail </button>
                        </a>
                       <a href="'.url("/admin/kelas/delete/$action->id_kelas").'">
                           <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
                       </a>
                    ';
            return $column;
        })->addColumn('nama_kelas',function($add){
            return $add->kelas_tingkat.' '.$add->nama_jurusan.' '.$add->urutan_kelas;
        })->make(true);
        return $datatables;
    }

    public function dataKelasDetail($id)
    {
        $kelas_detail = AnggotaPerpus::getByIdKelas($id);
        $datatables = Datatables::of($kelas_detail)->addColumn('action',function($action){
            $column   = '<a href="'.url("/admin/kelas/detail/$action->id_kelas/edit/$action->id_anggota").'">
                           <button class="btn btn-warning"> Edit </button>
                        </a>
                        <a href="'.url("/admin/kelas/detail/$action->id_kelas/delete/$action->id_anggota").'">
                           <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
                        </a>';
            return $column;
        })->addColumn('kelas_siswa',function($add){
            return $add->kelas_tingkat.' '.$add->nama_jurusan.' '.$add->urutan_kelas;
        })->make(true);
        return $datatables;
    }

    public function dataAturanPinjam()
    {
        $aturan_pinjam = AturanPinjam::all();
        $datatables = Datatables::of($aturan_pinjam)->addColumn('action',function($action){
            $array = [
                0 => ['class'=>'btn-success','text'=>'Aktifkan'],
                1 => ['class'=>'btn-danger','text'=>'Nonaktifkan']
            ];
            $column = '<a href="'.url("/admin/aturan-pinjam/edit/$action->id_aturan_pinjam").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <a href="'.url("/admin/aturan-pinjam/delete/$action->id_aturan_pinjam").'">
                           <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
                       </a>';
            return $column;
        })->rawColumns(['action','isi_aturan'])->make(true);
        return $datatables;
    }

    public function dataPanduanPinjam()
    {
        $panduan_pinjam = PanduanPinjam::all();
        $datatables = Datatables::of($panduan_pinjam)->addColumn('action',function($action){
            $column = '<a href="'.url("/admin/panduan-pinjam/edit/$action->id_panduan_pinjam").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <a href="'.url("/admin/panduan-pinjam/delete/$action->id_panduan_pinjam").'">
                           <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
                       </a>';
            return $column;
        })->editColumn('foto_panduan',function($edit){
            return '<img class="img-responsive img-fluid img-thumbnail" src="'.asset("/front-assets/foto_panduan/$edit->foto_panduan").'">';
        })->rawColumns(['foto_panduan','action'])->make(true);
        return $datatables;
    }

    public function dataPetugas() 
    {
        $petugas    = Petugas::showData();
        $datatables = Datatables::of($petugas)->addColumn('action',function($action){
            $array = [
                0 => ['class'=>'btn-success','text'=>'Aktifkan'],
                1 => ['class'=>'btn-danger','text'=>'Nonaktifkan']
            ];
            $column = '<a href="'.url("/admin/data-petugas/edit/$action->id_petugas").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <a href="'.url("/admin/data-petugas/delete/$action->id_petugas").'">
                           <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
                       </a>
                       <a href="'.url("/admin/data-petugas/status-petugas/$action->id_petugas").'">
                            <button class="btn '.$array[$action->status_akun]['class'].'">'.$array[$action->status_akun]['text'].'</button>
                       </a>
                    ';
            return $column;
        })->editColumn('jabatan',function($edit){
            return unslug_str($edit->jabatan);
        })->addColumn('status_petugas',function($status){
            $array = [
                0 => ['class'=>'badge badge-danger','text'=>'Non Aktif'],
                1 => ['class'=>'badge badge-success','text'=>'Aktif']
            ];
            return '<span class="'.$array[$status->status_akun]['class'].'">'.$array[$status->status_akun]['text'].'</span>';
        })->rawColumns(['status_petugas','action'])->make(true);
        return $datatables;
    }

    public function dataBuku() 
    {
        $buku = Buku::showData();
        $datatables = Datatables::of($buku)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/data-buku/cetak-label/$action->id_buku").'">
                          <button class="btn btn-success"> Cetak Label </button>
                       </a>
                       <a href="'.url("/$this->level/data-buku/cetak-barcode/$action->id_buku").'">
                          <button class="btn btn-success"> Cetak Barcode </button>
                       </a>
                       <a href="'.url("/$this->level/data-buku/edit/$action->id_buku").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <a href="'.url("/$this->level/data-buku/delete/$action->id_buku").'">
                           <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
                       </a>
                    ';
            return $column;
        })
        ->editColumn('stok_buku',function($edit){
            if ($edit->stok_buku > 0) 
            {
                $stok = '<span class="badge badge-success">'.$edit->stok_buku.'</span>';
            } else {
                $stok = '<span class="badge badge-danger">0</span>';
            }
            return $stok;
        })
        ->rawColumns(['action','stok_buku'])->make(true);
        return $datatables;
    }

    public function dataBukuRusak() 
    {
        $buku_rusak = BukuRusak::getData();
        $datatables = Datatables::of($buku_rusak)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/data-buku-rusak/edit/$action->id_buku_rusak").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <a href="'.url("/$this->level/data-buku-rusak/delete/$action->id_buku_rusak").'">
                           <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
                       </a>
                    ';
            return $column;
        })->make(true);
        return $datatables;
    }

    public function dataKategori() 
    {
        $kategori = Kategori::where('status_delete',0)->get();
        $datatables = Datatables::of($kategori)->addColumn('action',function($action){

            $column = '<a href="'.url("/admin/kategori-buku/edit/$action->id_kategori_buku").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <a href="'.url("/admin/kategori-buku/delete/$action->id_kategori_buku").'">
                           <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
                       </a>
                       <a href="'.url("/admin/sub-kategori/$action->id_kategori_buku").'">
                           <button class="btn btn-info"> Lihat Sub </button>
                       </a>
                    ';
            return $column;
        })->make(true);
        return $datatables;
    }

    public function dataSubKategori($id_ktg) 
    {
        $sub_ktg = SubKategori::getDataTables($id_ktg);
        $datatables = Datatables::of($sub_ktg)->addColumn('action',function($action){
            $column = '<a href="'.url("/admin/sub-kategori/edit/$action->id_sub_ktg").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <a href="'.url("/admin/sub-kategori/delete/$action->id_sub_ktg").'" onclick="return confirm(\'Yakin Hapus ?\');">
                           <button class="btn btn-danger"> Hapus </button>
                       </a>
                    ';
            return $column;
        })->make(true);
        return $datatables;
    }

    public function dataSuratBebasPustaka(Request $request)
    {
        $surat_bebas_pustaka = SuratBebasPustaka::getData();
        $datatables = Datatables::of($surat_bebas_pustaka)->addColumn('action',function($action){
            $column = '<a href="'.url("/admin/surat-bebas-pustaka/edit/$action->id_surat_bebas_pustaka").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <a href="'.url("/admin/surat-bebas-pustaka/delete/$action->id_surat_bebas_pustaka").'" onclick="return confirm(\'Yakin Hapus ?\');">
                           <button class="btn btn-danger"> Hapus </button>
                       </a>
                    ';
            return $column;
        })->make(true);
        return $datatables;
    }

    public function dataTransaksi(Request $request,$jenis) 
    {
        $transaksi = Transaksi::showData($jenis);
        $url       = $request->segment(3);
        $datatables = Datatables::of($transaksi)->addColumn('action',function($action)use($url){
            $column = ' <a href="'.url("/$this->level/transaksi-buku/detail-transaksi/$url/$action->id_transaksi").'">
                            <button class="btn btn-info">
                                Detail
                            </button>
                        </a>
                        <a href="'.url("/$this->level/transaksi-buku/delete/$action->id_transaksi").'" onclick="return confirm(\'Yakin Hapus ?\');">
                           <button class="btn btn-danger"> Hapus </button>
                       </a>
                    ';
            if ($url == 'siswa') 
            {
                $column .= '
                        <a href="'.url("/$this->level/transaksi-buku/siswa/cetak-bebas-pustaka/$action->id_transaksi").'">
                           <button class="btn btn-success"> Cetak Bebas Pustaka </button>
                       </a>';
            }
            return $column;
        })->addColumn('kelas_siswa',function($add){
            return $add->kelas_tingkat.' '.$add->nama_jurusan.' '.$add->urutan_kelas;
        })->make(true);
        return $datatables;
    }

    public function dataDetailTransaksi(Request $request,$id) 
    {
        $detail = TransaksiDetail::showData($id);
        $segment = $request->segment(4);
        $datatables = Datatables::of($detail)->addColumn('action',function($action)use($segment){
            // $cek = $action->status_transaksi == 'pending' ? '' : 'disabled="disabled"';
            if ($action->status_transaksi == 'pending') 
            {
            $column = '<a href="'.url("/$this->level/transaksi-buku/detail-transaksi/$segment/$action->id_transaksi/konfirmasi/$action->id_detail_transaksi").'">
                           <button class="btn btn-info"> Konfirmasi Pinjam </button>
                      </a>';
            }
            else if($action->status_transaksi == 'sedang-dipinjam') {
                $column = '
                <a href="'.url("/$this->level/transaksi-buku/detail-transaksi/$segment/$action->id_transaksi/kirim-email/$action->id_detail_transaksi").'">
                  <button class="btn btn-info"> Kirim Pengingat </button>
                </a>';
            }
            else {
                $column = '';
            }
              $column.='
               <a href="'.url("/$this->level/transaksi-buku/detail-transaksi/$action->id_transaksi/delete/$action->id_detail_transaksi").'" onclick="return confirm(\'Yakin Hapus ?\');">
                   <button class="btn btn-danger"> Hapus </button>
               </a>';
            return $column;
        })->editColumn('tanggal_pinjam',function($edit){
            return date_explode($edit->tanggal_pinjam);
        })->editColumn('tanggal_harus_kembali',function($edit){
            return date_explode($edit->tanggal_harus_kembali);
        })->editColumn('tanggal_kembali',function($edit){
            if ($edit->tanggal_kembali == NULL) 
            {
                $tanggal_kembali = '-';
            }
            else {
                $tanggal_kembali = date_explode($edit->tanggal_kembali);
            }
            return $tanggal_kembali;
        })->editColumn('denda',function($edit){
            if ($edit->denda == NULL) 
            {
                $denda = '-';
            }
            else {
                $denda = rupiah_format($edit->denda);
            }
            return $denda;
        })->editColumn('status_transaksi',function($edit){
            $array = [
                'batal-pinjam'    => ['class' => 'badge-danger','text' => 'Batal Pinjam'],
                'pending'         => ['class' => 'badge-warning','text' => 'Pending'],
                'sedang-dipinjam' => ['class' => 'badge-info','text' => 'Sedang Dipinjam'],
                'kembali'         => ['class' => 'badge-success','text' => 'Kembali'],
                'hilang'          => ['class' => 'badge-danger','text' => 'Hilang']
            ];
            $label = '<span class="badge '.$array[$edit->status_transaksi]['class'].'">'.$array[$edit->status_transaksi]['text'].'</span>';
            return $label;
        })->rawColumns(['action','status_transaksi'])->make(true);
        return $datatables;
    }

    public function getSubKategori($id) 
    {
        $sub = SubKategori::where('id_kategori_buku',$id)->orderBy('id_sub_ktg','desc')->get();
        echo '<option selected="selected" disabled="disabled">=== Pilih Sub Kategori ===</option>';
        foreach ($sub as $key => $value) 
        {
            echo '<option value="'.$value->id_sub_ktg.'">'.$value->nama_sub.'</option>';
        }
    }

    public function getBuku($id) 
    {
        $buku = Buku::where('id_sub_ktg',$id)->orderBy('id_buku','desc')->get();
        echo '<option selected="selected" disabled="disabled">=== Pilih Buku ===</option>';
        foreach ($buku as $key => $value) 
        {
            echo '<option value="'.$value->id_buku.'">'.$value->judul_buku.'</option>';
        }
    }

    public function getBukuBarcode($barcode) 
    {
        $barcode = Barcode::where('code_scanner',$barcode)->firstOrFail();
        $buku    = Buku::where('id_buku',$barcode->id_buku)->firstOrFail();
        $html    = '<option value="'.$barcode->id_buku.'" selected="selected">'.$buku->judul_buku.'</option>';

        return $html;
    }

    public function getSiswa($id_tahun_ajaran,$id_kelas) 
    {
        // dd($id_kelas);
        $siswa = AnggotaPerpus::getByKelasTahunAjaran($id_kelas,$id_tahun_ajaran);
        $data[0] = '<option selected="selected" disabled="disabled">=== Pilih Siswa ===</option>';
        foreach ($siswa as $value) 
        {
            $data[] = '<option value="'.$value->id_anggota_perpus.'">'.$value->nomor_induk.' | '.$value->nama_anggota.'</option>';
        }
        return $data;
    }

    public function checkPinBukuTamu(Request $request)
    {
        $pin_buku_tamu = $request->pin_buku_tamu;

        $check = PinBukuTamu::where('pin_buku_tamu',$pin_buku_tamu)->count();

        if ($check == 0) {
            $return = 'false';
        }
        else {
            $return = 'true';
        }

        return $return;
    }

    public function savePinBukuTamu(Request $request)
    {
        $pin_buku_tamu    = $request->pin_buku_tamu;
        $id_pin_buku_tamu = $request->id_pin_buku_tamu;

        $data_pin_buku_tamu = [
            'pin_buku_tamu' => $pin_buku_tamu
        ];

        if ($id_pin_buku_tamu == '') {
            PinBukuTamu::create($data_pin_buku_tamu);
        }
        else {
            PinBukuTamu::where('id_pin_buku_tamu',$id_pin_buku_tamu)->update($data_pin_buku_tamu);
        }

        return response(201);
    }

    public function getUpdates() 
    {
        Telegram::sendMessage(
            ['chat_id'=>env('GROUP_ID'),'text'=>'TEST']
        );
    }

    public function orderBuku($order,$buku = '') 
    {
        $array = [];
        $orderBy = [
            'terbaru' => 'desc',
            'lama'    => 'asc'
        ];

        if ($buku == '') 
        {
            $buku = Buku::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                         ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                         ->select('buku.*','sub_kategori.nama_sub','sub_kategori.slug_sub_ktg','kategori_buku.nama_kategori','kategori_buku.slug_kategori')
                         ->orderBy('id_buku',$orderBy[$order])
                         ->get();
            foreach ($buku as $key => $value) 
            {
                $array[] = [
                    'judul_buku'     => str_limit($value->judul_buku,17),
                    'judul_slug'     => $value->judul_slug,
                    'tanggal_upload' => tanggal_upload($value->tanggal_upload),
                    'nama_kategori'  => $value->nama_kategori,
                    'slug_kategori'  => $value->slug_kategori,
                    'nama_sub'       => $value->nama_sub,
                    'slug_sub_ktg'   => $value->slug_sub_ktg,
                    'foto_buku'      => $value->foto_buku
                ];
            }
        } else {
            //
        }
        return response()->json($array,201);
    }

    public function cariBuku($buku,$order) 
    {
        $data_buku = [];
        $get_buku  = Buku::join('sub_kategori','buku.id_sub_ktg','=','sub_kategori.id_sub_ktg')
                         ->join('kategori_buku','sub_kategori.id_kategori_buku','=','kategori_buku.id_kategori_buku')
                         ->select('buku.*','sub_kategori.nama_sub','sub_kategori.slug_sub_ktg','kategori_buku.nama_kategori','kategori_buku.slug_kategori')
                         ->where('judul_buku','like','%'.$buku.'%');

        if ($order == 'terbaru') 
        {
            $get = $get_buku->orderBy('id_buku','desc')->get();
        }
        foreach ($get as $key => $value) 
        {
            $data_buku[] = [
                'judul_buku'     => str_limit($value->judul_buku,17),
                'judul_slug'     => $value->judul_slug,
                'tanggal_upload' => tanggal_upload($value->tanggal_upload),
                'nama_kategori'  => $value->nama_kategori,
                'slug_kategori'  => $value->slug_kategori,
                'nama_sub'       => $value->nama_sub,
                'slug_sub_ktg'   => $value->slug_sub_ktg,
                'foto_buku'      => $value->foto_buku
            ];
        }

        return response()->json($data_buku,201);
    }

    public function wishlistBuku($id,$id_anggota) 
    {

    }
}
