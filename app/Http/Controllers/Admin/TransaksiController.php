<?php

namespace App\Http\Controllers\Admin;

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
        $title        = 'Transaksi Buku Siswa | Admin';
        $page         = 'transaksi-buku-siswa';
        $buku         = 'menu-open';
        $tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();

        return view('Pengurus.Admin.page.buku.transaksi-buku.main-siswa',compact('title','page','buku','tahun_ajaran'));
    }

    public function transaksiGuru() 
    {
        $title = 'Transaksi Buku Guru | Admin';
        $page  = 'transaksi-buku-guru';
        $buku  = 'menu-open';
        $type  = 'guru';
        return view('Pengurus.Admin.page.buku.transaksi-buku.main-guru',compact('title','page','buku','type'));   
    }

    public function pinjamSiswa() 
    {
        $title        = 'Form Pinjam Siswa | Admin';
        $page         = 'transaksi-buku-siswa';
        $buku         = 'menu-open';
        $tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();
        $kelas        = Kelas::showKelasSiswa();
        return view('Pengurus.Admin.page.buku.transaksi-buku.form-pinjam-siswa',compact('title','page','buku','tahun_ajaran','kelas'));
    }

    public function pinjamGuru() 
    {
        $title    = 'Form Pinjam Guru | Admin';
        $page     = 'transaksi-buku-guru';
        $buku     = 'menu-open';
        $guru     = AnggotaPerpus::getGuru();
        return view('Pengurus.Admin.page.buku.transaksi-buku.form-pinjam-guru',compact('title','page','buku','guru'));
    }

    public function detailTransaksiSiswa($id) 
    {
        $title = 'Transaksi Detail | Admin';
        $page  = 'transaksi-buku-siswa';
        $buku  = 'menu-open';
        $siswa = Transaksi::siswaTrans($id);
        return view('Pengurus.Admin.page.buku.transaksi-buku.main-siswa-detail',compact('title','page','buku','id','siswa'));
    }

    public function detailTransaksiGuru($id) 
    {
        $title = 'Transaksi Detail Guru | Admin';
        $page  = 'transaksi-buku-guru';
        $buku  = 'menu-open';
        return view('Pengurus.Admin.page.buku.transaksi-buku.main-guru-detail',compact('title','page','buku','id'));
    }

    public function deleteTransaksi($id) 
    {
        $tipe_anggota = Transaksi::getTipeAnggotaById($id);
        Transaksi::where('id_transaksi',$id)->delete();

        return redirect('/admin/transaksi-buku/'.$tipe_anggota)->with('message','Berhasil Hapus Data');
    }

    public function deleteDetailTransaksi($id,$id_detail) 
    {
        $tipe_anggota = TransaksiDetail::getRowDetail($id,$id_detail)->tipe_anggota;
        TransaksiDetail::where('id_transaksi',$id)
                        ->where('id_detail_transaksi',$id_detail)
                        ->delete();

        $message[0] = ['class'=>'alert-success','text'=>'Berhasil Hapus Detail Transaksi'];
        return redirect('/admin/transaksi-buku/detail-transaksi/'.$tipe_anggota.'/'.$id)->with('message',$message);
    }

    public function konfirmasiPinjamSiswa($id,$id_detail)
    {
        $title      = 'Konfirmasi Pinjam Siswa';
        $page       = 'transaksi-buku-siswa';
        $buku       = 'menu-open';
        $konfirmasi = TransaksiDetail::getRowKonfirmasi($id,$id_detail);

        return view('Pengurus.Admin.page.buku.transaksi-buku.form-konfirmasi-siswa',compact('title','konfirmasi','id','id_detail','page','buku'));
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

        return redirect('/admin/transaksi-buku/detail-transaksi/'.$tipe.'/'.$id_transaksi)->with('message',$message);
    }

    public function kembaliSiswa() 
    {
        $title = 'Form Kembali Siswa | Admin';
        $page = 'transaksi-buku-siswa';
        $buku = 'menu-open';
        $tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();
        $kelas        = Kelas::showKelasSiswa();
        return view('Pengurus.Admin.page.buku.transaksi-buku.form-kembali-siswa',compact('title','page','buku','tahun_ajaran','kelas'));
    }

    public function kembaliGuru() 
    {
        $title = 'Form Kembali Guru | Admin';
        $page = 'transaksi-buku-guru';
        $buku = 'menu-open';
        return view('Pengurus.Admin.page.buku.transaksi-buku.form-kembali-guru',compact('title','page','buku'));
    }

    public function pinjamPost(Request $request) 
    {
        $anggota               = $request->anggota;
        $buku                  = $request->buku;
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
        foreach ($buku as $key => $value) {

            $id_buku         = Barcode::getBuku($value);
            $count           = TransaksiDetail::where('kode_buku',$value)->where('status_transaksi','sedang-dipinjam')->count();
            $cek_ktg         = TransaksiDetail::cekKtg($anggota,$id_buku->id_kategori_buku);
            $get_anggota     = $anggota;

            if ($count == 0 && $cek_ktg == true) {
                $cek_stok = Buku::where('id_buku',$id_buku->id_buku)->firstOrFail()->stok_buku;
                if ($cek_stok > 0) {
                    $pinjam[] = [
                        'id_transaksi'          => $getId,
                        'id_buku'               => $id_buku->id_buku,
                        'kode_buku'             => $value,
                        'stok_transaksi'        => $stok_pinjam,
                        'tanggal_pinjam'        => $tanggal_pinjam,
                        'tanggal_harus_kembali' => $tanggal_harus_kembali,
                        'status_transaksi'      => 'sedang-dipinjam'
                    ];
                    $flash = ['class'=>'alert-success','text'=>'Buku <b>'.$id_buku->judul_buku.'</b> Berhasil Dipinjam'];
                }
                else {
                    $flash = ['class'=>'alert-danger','text'=>'Stok Buku <b>'.$id_buku->judul_buku.'</b> Telah Habis'];
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

        if (isset($pinjam)) {
            TransaksiDetail::insert($pinjam);
        }
        
        return redirect('/admin/transaksi-buku/detail-transaksi/'.$tipe.'/'.$getId)->with('message',$message);
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

        return redirect('/admin/transaksi-buku/detail-transaksi/'.$tipe.'/'.$id_transaksi)->with('message',$flash);
    }

    public function bebasPustaka($id)
    {
        $siswa         = Transaksi::siswaTrans($id);
        $bebas_pustaka = new SuratBebasPustaka;

        return view('Pengurus.Admin.page.buku.transaksi-buku.bebas-pustaka',compact('siswa','bebas_pustaka'));
    }

    public function perpanjang($id) 
    {
    	//
    }

    public function savePerpanjang(Request $request) 
    {
        //
    }

    public function cetakTransaksi(Request $request) 
    {
        $title       = str_replace('/',' - ',$request->tahun_ajaran);
        $fileName    = 'Rekapitulasi Peminjaman Buku Th Ajaran. '.$title.'.xlsx';
        $spreadsheet = new Spreadsheet();

        $customCellMonth = ['font'  => [
                            'bold'  => true,
                            'size'  => 12,
                            'name'  => 'Times New Roman'
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]
                    ];
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $spreadsheet->getDefaultStyle()->getFont()->setSize('12');
        $bulan_sheet = 0;
        $cell_data   = [];
        $sheet_index = 0;

        $explode = explode('/',$request->tahun_ajaran);

        for ($x=0; $x < count($explode); $x++) {
            for ($i=0; $i < 12; $i++) {
                $bulan_sheet = $i+1;
                $spreadsheet->setActiveSheetIndex($sheet_index)->setTitle(month($bulan_sheet).', '.$explode[$x]);

                $drawing = new Drawing();
                $drawing->setName('Kop Laporan');
                $drawing->setDescription('Kop Laporan');
                $drawing->setPath('admin-assets/dist/img/kop_laporan.jpeg');
                $drawing->setWidth(150);
                $drawing->setHeight(150);
                $drawing->setCoordinates('B1');
                $drawing->setOffsetX(45);
                $drawing->setWorksheet($spreadsheet->getActiveSheet());

                $spreadsheet->getActiveSheet()->setCellValue('C8','Rekapitulasi Jumlah Pengunjung');
                $spreadsheet->getActiveSheet()->setCellValue('C9','Perpustakaan SMK Negeri 7 Samarinda');
                $spreadsheet->getActiveSheet()->setCellValue('C10','Bulan : '.month($bulan_sheet));
                $spreadsheet->getActiveSheet()->setCellValue('H10','Tahun : '.$explode[$x]);
                $spreadsheet->getActiveSheet()->getStyle('C8:C9')->getFont()->setSize(14);
                $spreadsheet->getActiveSheet()->setCellValue('C11','No');
                $spreadsheet->getActiveSheet()->setCellValue('D11','Hari / Tanggal');
                $spreadsheet->getActiveSheet()->setCellValue('F11','Jumlah Buku Dipinjam');
                $spreadsheet->getActiveSheet()->setCellValue('G11','Jumlah Buku Kembali');
                $spreadsheet->getActiveSheet()->setCellValue('H11','Ket');
                $spreadsheet->getActiveSheet()->mergeCells('C8:H8');
                $spreadsheet->getActiveSheet()->mergeCells('C9:H9');
                $spreadsheet->getActiveSheet()->mergeCells('C10:D10');
                $spreadsheet->getActiveSheet()->mergeCells('D11:E11');
                $spreadsheet->getActiveSheet()->getStyle('C8:C9')->getFont()->setBold(true);
                $spreadsheet->getActiveSheet()->getStyle('C10:H10')->getFont()->setBold(true);
                $spreadsheet->getActiveSheet()->getStyle('C11:H11')->applyFromArray($customCellMonth);
                $spreadsheet->getActiveSheet()->getStyle('F11:G11')->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->getStyle('C8:C9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(15);
                $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(16);
                $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(16);
                $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(16);
                for ($k=1; $k <= days_in_month($bulan_sheet,$explode[$x]) ; $k++) {
                    $set_sheet = $k+11;
                    if (strlen($k) == 1) {
                        $tanggal_cell = '0'.(string)$k;
                    }
                    else {
                        $tanggal_cell = $k;
                    }
                    $spreadsheet->getActiveSheet()->setCellValue('C'.$set_sheet,$k);
                    $spreadsheet->getActiveSheet()->setCellValue('D'.$set_sheet,get_dayname($k,$bulan_sheet,$explode[$x]));
                    $spreadsheet->getActiveSheet()->setCellValue('E'.$set_sheet,','.$tanggal_cell);
                    $spreadsheet->getActiveSheet()->setCellValue('F'.$set_sheet,TransaksiDetail::countPeminjaman('sedang-dipinjam',create_date($k,$bulan_sheet,$explode[$x])));
                    $spreadsheet->getActiveSheet()->setCellValue('G'.$set_sheet,TransaksiDetail::countPeminjaman('kembali',create_date($k,$bulan_sheet,$explode[$x])));

                    if (get_dayname($k,$bulan_sheet,$explode[$x]) == 'Minggu') {
                        $spreadsheet->getActiveSheet()->getStyle('C'.$set_sheet.':H'.$set_sheet)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');
                    }
                    $spreadsheet->getActiveSheet()->getRowDimension($set_sheet)->setRowHeight(18);

                    $cell_data[$i]['cell_pos'] = $set_sheet;
                }
                $sheet_index = $sheet_index+1;
                $cell_count  = $cell_data[$i]['cell_pos']+1;
                $cell_sign   = $cell_count+2;
                $cell_job    = $cell_count+3;
                $cell_name   = $cell_count+7;
                $cell_nip    = $cell_count+8;

                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_count,'Total');
                $spreadsheet->getActiveSheet()->mergeCells('C'.$cell_count.':E'.$cell_count);
                $spreadsheet->getActiveSheet()->setCellValue('F'.$cell_count,TransaksiDetail::countTotalPerMonth('sedang-dipinjam',$bulan_sheet,$explode[$x]));
                $spreadsheet->getActiveSheet()->setCellValue('G'.$cell_count,TransaksiDetail::countTotalPerMonth('kembali',$bulan_sheet,$explode[$x]));
                $spreadsheet->getActiveSheet()->getStyle('C'.$cell_count.':H'.$cell_count)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF00FF');

                $spreadsheet->getActiveSheet()->getStyle('C12:H'.$cell_count)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle('C12:H'.$cell_count)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $styleTable = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];
                $spreadsheet->getActiveSheet()->getStyle('C11:H'.$cell_count)->applyFromArray($styleTable);

                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_sign,'Mengetahui,');
                $spreadsheet->getActiveSheet()->setCellValue('H'.$cell_sign,'Samarinda,          '.$explode[$x]);
                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_job,'Kepala Tata Administrasi');
                $spreadsheet->getActiveSheet()->setCellValue('H'.$cell_job,'Kepala Perpustakaan');
                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_name,'Jumran, S.Pd');
                $spreadsheet->getActiveSheet()->setCellValue('H'.$cell_name,'Khairul Anam, M.Pd');
                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_nip,'NIP.19660507 199011 1 001');
                $spreadsheet->getActiveSheet()->setCellValue('H'.$cell_nip,'NIP.19670512 200701 1 038');

                $spreadsheet->getActiveSheet()->getStyle('C'.$cell_name)->getFont()->setUnderline(true);
                $spreadsheet->getActiveSheet()->getStyle('C'.$cell_name.':H'.$cell_nip)->getFont()->setBold(true);
                $spreadsheet->getActiveSheet()->getSheetView()->setZoomScale(145);
                $spreadsheet->getActiveSheet()->getRowDimension('11')->setRowHeight(40);
                $spreadsheet->getActiveSheet()->getRowDimension($cell_count)->setRowHeight(23);

                $spreadsheet->getActiveSheet()->getPageSetup()
                            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $spreadsheet->getActiveSheet()->getPageSetup()
                            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

                $spreadsheet->createSheet();
            }
        }
        // $spreadsheet->setActiveSheetIndex($sheet_index)->setTitle('Rekap Th Ajaran '.$title);

        // $drawing = new Drawing();
        // $drawing->setName('Kop Laporan');
        // $drawing->setDescription('Kop Laporan');
        // $drawing->setPath('admin-assets/dist/img/kop_laporan.jpeg'); // put your path and image here
        // $drawing->setWidth(150);
        // $drawing->setHeight(150);
        // $drawing->setCoordinates('B1');
        // $drawing->setOffsetX(45);
        // $drawing->setWorksheet($spreadsheet->getActiveSheet());

        // $spreadsheet->getActiveSheet()->getSheetView()->setZoomScale(130);
        // $spreadsheet->getActiveSheet()->setCellValue('D8','Rekapitulasi Jumlah Pengunjung');
        // $spreadsheet->getActiveSheet()->setCellValue('D9','Perpustakaan SMK Negeri 7 Samarinda');
        // $spreadsheet->getActiveSheet()->setCellValue('D10','Tahun '.$explode[1]);
        // $spreadsheet->getActiveSheet()->setCellValue('D11','No.');
        // $spreadsheet->getActiveSheet()->setCellValue('E11','Bulan');
        // $spreadsheet->getActiveSheet()->setCellValue('F11','Jumlah Seluruh Pengunjung');
        // $spreadsheet->getActiveSheet()->setCellValue('G11','Ket');

        // $spreadsheet->getActiveSheet()->mergeCells('D8:G8');
        // $spreadsheet->getActiveSheet()->mergeCells('D9:G9');
        // $spreadsheet->getActiveSheet()->mergeCells('D10:G10');

        // $styleArray = ['font'  => [
        //                     'bold'  => true,
        //                     'size'  => 14,
        //                     'name'  => 'Times New Roman'
        //                 ],
        //                 'alignment' => [
        //                     'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        //                 ]
        //             ];

        // $spreadsheet->getActiveSheet()->getStyle('D8:D10')->applyFromArray($styleArray);
        // $spreadsheet->getActiveSheet()->getStyle('D11:G11')->getFont()->setSize(12)->setName('Times New Roman');

        // $bulan_rekap_tahun = '';
        // $cell_worksheet_tahun = 12;
        // for ($j=1; $j <= 12; $j++) {
        //     if (strlen($j) == 1) {
        //         $bulan_rekap_tahun = '0'.$j;
        //     }
        //     else {
        //         $bulan_rekap_tahun = $j;
        //     }
        //     $spreadsheet->getActiveSheet()->setCellValue('D'.$cell_worksheet_tahun,$j);
        //     $spreadsheet->getActiveSheet()->setCellValue('E'.$cell_worksheet_tahun,month($j));
        //     $spreadsheet->getActiveSheet()->setCellValue('F'.$cell_worksheet_tahun,BukuTamu::countPerYear($bulan_rekap_tahun,$explode[1]));
        //     $spreadsheet->getActiveSheet()->getRowDimension($cell_worksheet_tahun)->setRowHeight(18);
        //     $cell_worksheet_tahun = $cell_worksheet_tahun + 1;
        // }
        // $styleTable2 = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];
        // $spreadsheet->getActiveSheet()->getStyle('D11:G24')->applyFromArray($styleTable2);
        // $spreadsheet->getActiveSheet()->getStyle('D12:D23')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // $spreadsheet->getActiveSheet()->getStyle('F12:F23')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // $spreadsheet->getActiveSheet()->setCellValue('D24','Total');
        // $spreadsheet->getActiveSheet()->setCellValue('F24','=SUM(F12:F23)');
        // $spreadsheet->getActiveSheet()->mergeCells('D24:E24');

        // $spreadsheet->getActiveSheet()->getStyle('D24:F24')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // $spreadsheet->getActiveSheet()->getStyle('D24:F24')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        // $spreadsheet->getActiveSheet()->getStyle('D11:G11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // $spreadsheet->getActiveSheet()->getStyle('D11:G11')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // $spreadsheet->getActiveSheet()->getStyle('F11')->getAlignment()->setWrapText(true);
        // $spreadsheet->getActiveSheet()->getStyle('D11:G11')->getFont()->setBold(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        // $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        // $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        // $spreadsheet->getActiveSheet()->getRowDimension('24')->setRowHeight(23);

        // $spreadsheet->getActiveSheet()->setCellValue('B26','Mengetahui,');
        // $spreadsheet->getActiveSheet()->setCellValue('B27','Kepala Tata Administrasi');
        // $spreadsheet->getActiveSheet()->setCellValue('H26','Samarinda,          '.$explode[1]);
        // $spreadsheet->getActiveSheet()->setCellValue('H27','Kepala Perpustakaan');
        // $spreadsheet->getActiveSheet()->setCellValue('B31','Jumran, S.Pd');
        // $spreadsheet->getActiveSheet()->setCellValue('B32','NIP.19660507 199011 1 001');
        // $spreadsheet->getActiveSheet()->setCellValue('H31','Khairul Anam, M.Pd');
        // $spreadsheet->getActiveSheet()->setCellValue('H32','NIP.19670512 200701 1 038');
        // $spreadsheet->getActiveSheet()->getStyle('B31:H32')->getFont()->setBold(true);

        // $spreadsheet->getActiveSheet()->getStyle('D11:G11')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');
        // $spreadsheet->getActiveSheet()->getStyle('D24:G24')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');
        // $spreadsheet->getActiveSheet()->getRowDimension('23')->setRowHeight(23);

        // $spreadsheet->getActiveSheet()->getPageSetup()
        //             ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // $spreadsheet->getActiveSheet()->getPageSetup()
        //             ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

        $spreadsheet->setActiveSheetIndex(0);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        // $writer->setIncludeCharts(true);
        $writer->save('php://output');
    }
}
