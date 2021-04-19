<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiModel as Transaksi;
use App\Models\TransaksiDetailModel as TransaksiDetail;
use App\Models\TahunAjaranModel as TahunAjaran;
use App\Models\PetugasModel as Petugas;
use App\Models\KelasTingkatModel as KelasTingkat;
use App\Models\KelasModel as Kelas;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Http\Request;

class LaporanTransaksiController extends Controller
{
    public function index()
    {
		$title        = 'Laporan';
		$page         = 'laporan';
		$buku         = 'menu-open';
		$tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();

    	return view('Pengurus.Admin.page.buku.laporan.main',compact('title','page','buku','tahun_ajaran'));
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
        // $bulan_sheet = 0;
        $cell_data   = [];
        $sheet_index = 0;

        $explode = explode('/',$request->tahun_ajaran);

        for ($x=0; $x < count($explode); $x++) {
            for ($i=0; $i < 6; $i++) {
                // $bulan_sheet = $i+1;
                $spreadsheet->setActiveSheetIndex($sheet_index)->setTitle(month(bulan_tahun_ajaran($x,$i)).', '.$explode[$x]);

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
                $spreadsheet->getActiveSheet()->setCellValue('C10','Bulan : '.month(bulan_tahun_ajaran($x,$i)));
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
                for ($k=1; $k <= days_in_month(bulan_tahun_ajaran($x,$i),$explode[$x]) ; $k++) {
                    $set_sheet = $k+11;
                    if (strlen($k) == 1) {
                        $tanggal_cell = '0'.(string)$k;
                    }
                    else {
                        $tanggal_cell = $k;
                    }
                    $spreadsheet->getActiveSheet()->setCellValue('C'.$set_sheet,$k);
                    $spreadsheet->getActiveSheet()->setCellValue('D'.$set_sheet,get_dayname($k,bulan_tahun_ajaran($x,$i),$explode[$x]));
                    $spreadsheet->getActiveSheet()->setCellValue('E'.$set_sheet,','.$tanggal_cell);
                    $spreadsheet->getActiveSheet()->setCellValue('F'.$set_sheet,TransaksiDetail::countPeminjaman('sedang-dipinjam',create_date($k,bulan_tahun_ajaran($x,$i),$explode[$x])));
                    $spreadsheet->getActiveSheet()->setCellValue('G'.$set_sheet,TransaksiDetail::countPeminjaman('kembali',create_date($k,bulan_tahun_ajaran($x,$i),$explode[$x])));

                    if (get_dayname($k,bulan_tahun_ajaran($x,$i),$explode[$x]) == 'Minggu') {
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
                $spreadsheet->getActiveSheet()->setCellValue('F'.$cell_count,TransaksiDetail::countTotalPerMonth('sedang-dipinjam',bulan_tahun_ajaran($x,$i),$explode[$x]));
                $spreadsheet->getActiveSheet()->setCellValue('G'.$cell_count,TransaksiDetail::countTotalPerMonth('kembali',bulan_tahun_ajaran($x,$i),$explode[$x]));
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
                $spreadsheet->getActiveSheet()->setCellValue('H'.$cell_name,Petugas::where('jabatan','kepala-perpustakaan')->firstOrFail()->nama_petugas);
                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_nip,'NIP.19660507 199011 1 001');
                $spreadsheet->getActiveSheet()->setCellValue('H'.$cell_nip,'NIP.'.Petugas::where('jabatan','kepala-perpustakaan')->firstOrFail()->nip);

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
        $spreadsheet->setActiveSheetIndex($sheet_index)->setTitle('Rekap Th Ajaran '.$title);

        $drawing = new Drawing();
        $drawing->setName('Kop Laporan');
        $drawing->setDescription('Kop Laporan');
        $drawing->setPath('admin-assets/dist/img/kop_laporan.jpeg'); // put your path and image here
        $drawing->setWidth(150);
        $drawing->setHeight(150);
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX(55);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $spreadsheet->getActiveSheet()->getSheetView()->setZoomScale(130);
        $spreadsheet->getActiveSheet()->setCellValue('C8','Rekapitulasi Jumlah Pengunjung');
        $spreadsheet->getActiveSheet()->setCellValue('C9','Perpustakaan SMK Negeri 7 Samarinda');
        $spreadsheet->getActiveSheet()->setCellValue('C10','Tahun '.$explode[0].' - '.$explode[1]);
        $spreadsheet->getActiveSheet()->setCellValue('C11','No.');
        $spreadsheet->getActiveSheet()->setCellValue('D11','Bulan');
        $spreadsheet->getActiveSheet()->setCellValue('E11','Jumlah Buku Di Pinjam');
        $spreadsheet->getActiveSheet()->setCellValue('F11','Jumlah Buku Kembali');
        $spreadsheet->getActiveSheet()->setCellValue('G11','Ket');

        $spreadsheet->getActiveSheet()->mergeCells('C8:G8');
        $spreadsheet->getActiveSheet()->mergeCells('C9:G9');
        $spreadsheet->getActiveSheet()->mergeCells('C10:G10');

        $styleArray = ['font'  => [
                            'bold'  => true,
                            'size'  => 14,
                            'name'  => 'Times New Roman'
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                        ]
                    ];

        $spreadsheet->getActiveSheet()->getStyle('C8:D10')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C11:G11')->getFont()->setSize(12)->setName('Times New Roman');

        $bulan_rekap_tahun = '';
        $cell_worksheet_tahun = 12;

        for ($k=0; $k < count($explode); $k++) {
            for ($j=0; $j < 6; $j++) {
                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_worksheet_tahun,$j+1);
                $spreadsheet->getActiveSheet()->setCellValue('D'.$cell_worksheet_tahun,month(bulan_tahun_ajaran($k,$j)).', '.$explode[$k]);
                $spreadsheet->getActiveSheet()->setCellValue('E'.$cell_worksheet_tahun,TransaksiDetail::countPinjamPerYear(bulan_tahun_ajaran($k,$j),$explode[$k]));
                $spreadsheet->getActiveSheet()->setCellValue('F'.$cell_worksheet_tahun,TransaksiDetail::countKembaliPerYear(bulan_tahun_ajaran($k,$j),$explode[$k]));
                $spreadsheet->getActiveSheet()->getRowDimension($cell_worksheet_tahun)->setRowHeight(18);
                $cell_worksheet_tahun = $cell_worksheet_tahun + 1;
            }
        }

        $styleTable2 = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];
        $spreadsheet->getActiveSheet()->getStyle('C11:G24')->applyFromArray($styleTable2);
        $spreadsheet->getActiveSheet()->getStyle('C12:E23')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('F12:F23')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->setCellValue('C24','Total');
        $spreadsheet->getActiveSheet()->setCellValue('E24','=SUM(E12:E23)');
        $spreadsheet->getActiveSheet()->setCellValue('F24','=SUM(F12:F23)');
        $spreadsheet->getActiveSheet()->mergeCells('C24:D24');

        $spreadsheet->getActiveSheet()->getStyle('C24:F24')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('C24:F24')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('C11:G11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('C11:G11')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $spreadsheet->getActiveSheet()->getStyle('E11')->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle('F11')->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle('C11:G11')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(18);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $spreadsheet->getActiveSheet()->getRowDimension('24')->setRowHeight(23);

        $spreadsheet->getActiveSheet()->setCellValue('B26','Mengetahui,');
        $spreadsheet->getActiveSheet()->setCellValue('B27','Kepala Tata Administrasi');
        $spreadsheet->getActiveSheet()->setCellValue('G26','Samarinda,          '.$explode[1]);
        $spreadsheet->getActiveSheet()->setCellValue('G27','Kepala Perpustakaan');
        $spreadsheet->getActiveSheet()->setCellValue('B31','Jumran, S.Pd');
        $spreadsheet->getActiveSheet()->setCellValue('B32','NIP.19660507 199011 1 001');
        $spreadsheet->getActiveSheet()->setCellValue('G31','Khairul Anam, M.Pd');
        $spreadsheet->getActiveSheet()->setCellValue('G32','NIP.19670512 200701 1 038');
        $spreadsheet->getActiveSheet()->getStyle('B31:G32')->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->getStyle('C11:G11')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');
        $spreadsheet->getActiveSheet()->getStyle('C24:G24')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');

        $spreadsheet->getActiveSheet()->getPageSetup()
                    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

        $spreadsheet->setActiveSheetIndex(0);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        // $writer->setIncludeCharts(true);
        $writer->save('php://output');
    }

    public function cetakLaporanBukuK13(Request $request)
    {
        $title       = str_replace('/',' - ',$request->tahun_ajaran);
        $fileName    = 'Rekapitulasi Peminjaman Buku Th Ajaran. '.$title.' - BUKU PAKET K-13.xlsx';
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
        $sheet_cell  = 13;
        $cell_data[] = [];

        $explode = explode('/',$request->tahun_ajaran);
        $kelas_tingkat = KelasTingkat::whereNotIn('kelas_tingkat',['-'])->get();

        foreach ($kelas_tingkat as $key => $value) {

            $kelas = Kelas::join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                            ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                            ->where('kelas.id_kelas_tingkat',$value->id_kelas_tingkat)
                            ->get();

            $spreadsheet->setActiveSheetIndex($key)->setTitle('Kelas '.$value->kelas_tingkat);

            $drawing = new Drawing();
            $drawing->setName('Kop Laporan');
            $drawing->setDescription('Kop Laporan');
            $drawing->setPath('admin-assets/dist/img/kop_laporan.jpeg');
            $drawing->setWidth(150);
            $drawing->setHeight(150);
            $drawing->setCoordinates('B1');
            $drawing->setOffsetX(45);
            $drawing->setWorksheet($spreadsheet->getActiveSheet());

            $spreadsheet->getActiveSheet()->setCellValue('C8','Rekapitulasi Peminjaman Buku Paket Kurikulum 2013');
            $spreadsheet->getActiveSheet()->setCellValue('C9','Perpustakaan SMK Negeri 7 Samarinda');
            $spreadsheet->getActiveSheet()->setCellValue('C10','Paket Keahlian TKJ, RPL, MM');
            $spreadsheet->getActiveSheet()->getStyle('C8:C10')->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->setCellValue('C11','Kelas '.$value->kelas_tingkat);
            $spreadsheet->getActiveSheet()->setCellValue('C12','No.');
            $spreadsheet->getActiveSheet()->setCellValue('D12','Kelas');
            $spreadsheet->getActiveSheet()->setCellValue('E12','Pinjam');
            $spreadsheet->getActiveSheet()->setCellValue('F12','Tidak Pinjam');
            $spreadsheet->getActiveSheet()->setCellValue('G12','Ket');
            $spreadsheet->getActiveSheet()->mergeCells('C8:G8');
            $spreadsheet->getActiveSheet()->mergeCells('C9:G9');
            $spreadsheet->getActiveSheet()->mergeCells('C10:G10');
            $spreadsheet->getActiveSheet()->mergeCells('C11:D11');
            $spreadsheet->getActiveSheet()->getStyle('C8:C10')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('C11:G12')->applyFromArray($customCellMonth);
            $spreadsheet->getActiveSheet()->getStyle('C8:C10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(7);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(18);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(18);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(18);

            foreach ($kelas as $index => $data) {
                $count_not_exists = TransaksiDetail::countNotExistsPinjamK13($value->kelas_tingkat,$data->nama_jurusan,$data->urutan_kelas,$explode);
                
                $count_not_pinjam_k13 = 0;

                $get_siswa_transaksi = Transaksi::join('anggota_perpus','transaksi_buku.id_anggota_perpus','=','anggota_perpus.id_anggota_perpus')
                                    ->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
                                    ->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
                                    ->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
                                    ->join('tahun_ajaran','anggota_perpus.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
                                    ->where('kelas_tingkat',$value->kelas_tingkat)
                                    ->where('nama_jurusan',$data->nama_jurusan)
                                    ->where('urutan_kelas',$data->urutan_kelas)
                                    ->where('tahun_ajaran',$explode[0].'/'.$explode[1])
                                    ->get();                
                
                $count_total_pinjam   = 0;

                foreach ($get_siswa_transaksi as $key => $data_siswa) {

                $check_pinjam_k13 = TransaksiDetail::checkPinjamBukuK13($data_siswa->id_anggota_perpus,
                                                                        $data->kelas_tingkat);

                $check_tidak_pinjam_k13 = TransaksiDetail::checkTidakPinjamBukuK13($data_siswa->id_anggota_perpus,
                                                                        $data->kelas_tingkat);
                    if ($check_pinjam_k13 == 'true') {
                        $count_total_pinjam = $count_total_pinjam+1;
                    }
                    if ($check_tidak_pinjam_k13 == 'true') {
                        $count_not_pinjam_k13 = $count_not_pinjam_k13+1;
                    }
                }

                $count_total_tidak_pinjam = $count_not_exists + $count_not_pinjam_k13;

                $spreadsheet->getActiveSheet()->setCellValue('C'.$sheet_cell,$index+1);
                $spreadsheet->getActiveSheet()->setCellValue('D'.$sheet_cell,$value->kelas_tingkat.' '.$data->nama_jurusan.' '.$data->urutan_kelas);
                $spreadsheet->getActiveSheet()->setCellValue('E'.$sheet_cell,$count_total_pinjam);
                $spreadsheet->getActiveSheet()->setCellValue('F'.$sheet_cell,$count_total_tidak_pinjam);
                // $spreadsheet->getActiveSheet()->setCellValue('F'.$sheet_cell,0);
                $spreadsheet->getActiveSheet()->setCellValue('G'.$sheet_cell,'');

                $spreadsheet->getActiveSheet()->getRowDimension($sheet_cell)->setRowHeight(18);

                $sheet_cell = $sheet_cell + 1;

                $spreadsheet->getActiveSheet()->getStyle('C11:G'.$sheet_cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle('C11:G'.$sheet_cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }
            $sum_cell   = $sheet_cell-1;
            $cell_sign  = $sheet_cell+2;
            $cell_job   = $sheet_cell+3;
            $cell_name  = $sheet_cell+7;
            $cell_nip   = $sheet_cell+8;

            $spreadsheet->getActiveSheet()->setCellValue('C'.$sheet_cell,'Total');
            $spreadsheet->getActiveSheet()->setCellValue('E'.$sheet_cell,'=SUM(E13:E'.$sum_cell.')');
            $spreadsheet->getActiveSheet()->setCellValue('F'.$sheet_cell,'=SUM(F13:F'.$sum_cell.')');
            $spreadsheet->getActiveSheet()->setCellValue('G'.$sheet_cell,'');

            $spreadsheet->getActiveSheet()->mergeCells('C'.$sheet_cell.':D'.$sheet_cell);

            $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_sign,'Mengetahui,');
            $spreadsheet->getActiveSheet()->setCellValue('G'.$cell_sign,'Samarinda,          '.$explode[0]);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_job,'Kepala Tata Administrasi');
            $spreadsheet->getActiveSheet()->setCellValue('G'.$cell_job,'Kepala Perpustakaan');
            $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_name,'Jumran, S.Pd');
            $spreadsheet->getActiveSheet()->setCellValue('G'.$cell_name,Petugas::where('jabatan','kepala-perpustakaan')->firstOrFail()->nama_petugas);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_nip,'NIP.19660507 199011 1 001');
            $spreadsheet->getActiveSheet()->setCellValue('G'.$cell_nip,'NIP.'.Petugas::where('jabatan','kepala-perpustakaan')->firstOrFail()->nip);

            $spreadsheet->getActiveSheet()->getStyle('C'.$cell_name)->getFont()->setUnderline(true);
            $spreadsheet->getActiveSheet()->getStyle('C'.$cell_name.':G'.$cell_nip)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getSheetView()->setZoomScale(145);
            $spreadsheet->getActiveSheet()->getRowDimension('12')->setRowHeight(40);
            $spreadsheet->getActiveSheet()->getRowDimension($sheet_cell)->setRowHeight(24);
            
            $spreadsheet->getActiveSheet()->getStyle('C'.$sheet_cell.':G'.$sheet_cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');

            $styleTable = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];
            $spreadsheet->getActiveSheet()->getStyle('C12:G'.$sheet_cell)->applyFromArray($styleTable);

            $spreadsheet->getActiveSheet()->getPageSetup()
                        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $spreadsheet->getActiveSheet()->getPageSetup()
                        ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

            $spreadsheet->createSheet();

            $sheet_cell = 13;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        // $writer->setIncludeCharts(true);
        $writer->save('php://output');
    }
}
