<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnggotaModel as Anggota;
use App\Models\AnggotaPerpusModel as AnggotaPerpus;
use App\Models\BukuTamuModel as BukuTamu;
use App\Models\TahunAjaranModel as TahunAjaran;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class BukuTamuController extends Controller
{
    public function index()
    {
        $title        = 'Data Buku Tamu | Admin';
        $page         = 'data-buku-tamu';
        $tahun_ajaran = TahunAjaran::whereNotIn('tahun_ajaran',['-'])->get();

    	return view('Pengurus.Admin.page.buku-tamu.main',compact('title','page','tahun_ajaran'));
    }

    public function bukuTamu()
    {
    	$title = 'Buku Tamu | Admin';

    	return view('Pengurus.Admin.page.buku-tamu.buku-tamu',compact('title'));
    }

    public function save(Request $request)
    {
    	$nisn = $request->nisn;

    	if (Anggota::where('nomor_induk',$nisn)->count() == 0) {
    		$message = 'Data Tidak Ditemukan';
    	}

    	else {
	    	$anggota = AnggotaPerpus::join('anggota','anggota_perpus.id_anggota','=','anggota.id_anggota')
				    				->join('kelas','anggota_perpus.id_kelas','=','kelas.id_kelas')
				    				->join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
				    				->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
	    							->where('nomor_induk',$nisn)
	    							->firstOrFail();

	    	$data_buku_tamu = [
				'id_anggota_perpus'  => $anggota->id_anggota_perpus,
                'ket_buku_tamu'      => $request->ket_buku_tamu,
				'tanggal_berkunjung' => date('Y-m-d')
	    	];

	    	BukuTamu::create($data_buku_tamu);
            if ($anggota->tipe_anggota == 'siswa') {
                $message = 'Selamat Datang <b>'.$anggota->nomor_induk.' '.$anggota->nama_anggota.' '.$anggota->kelas_tingkat.' '.$anggota->nama_jurusan.' '.$anggota->urutan_kelas.'</b>';
            }
            else if($anggota->tipe_anggota == 'guru') {
                $message = 'Selamat Datang <b>'.$anggota->nomor_induk.' '.$anggota->nama_anggota.'</b>';
            }

    	}
    	return redirect('/admin/buku-tamu')->with('message',$message);
    }

    public function delete($id)
    {
    	BukuTamu::where('id_buku_tamu',$id)->delete();

    	return redirect('/admin/data-buku-tamu')->with('message','Berhasil Hapus Data Buku Tamu');
    }

    public function rekapPengunjung(Request $request)
    {
        $title       = str_replace('/',' - ',$request->tahun_ajaran);
        $fileName    = 'Rekapitulasi Pengunjung Th Ajaran. '.$title.'.xlsx';
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
                $spreadsheet->getActiveSheet()->setCellValue('J10','Tahun : '.$explode[$x]);
                $spreadsheet->getActiveSheet()->getStyle('C8:C9')->getFont()->setSize(14);
                $spreadsheet->getActiveSheet()->setCellValue('C11','No');
                $spreadsheet->getActiveSheet()->setCellValue('D11','Hari / Tanggal');
                $spreadsheet->getActiveSheet()->setCellValue('F11','Kelas');
                $spreadsheet->getActiveSheet()->setCellValue('I11','Guru / Karyawan Sekolah');
                $spreadsheet->getActiveSheet()->setCellValue('J11','Jumlah');
                $spreadsheet->getActiveSheet()->setCellValue('F12','X');
                $spreadsheet->getActiveSheet()->setCellValue('G12','XI');
                $spreadsheet->getActiveSheet()->setCellValue('H12','XII');
                $spreadsheet->getActiveSheet()->mergeCells('C8:J8');
                $spreadsheet->getActiveSheet()->mergeCells('C9:J9');
                $spreadsheet->getActiveSheet()->mergeCells('C10:D10');
                $spreadsheet->getActiveSheet()->mergeCells('C11:C12');
                $spreadsheet->getActiveSheet()->mergeCells('D11:E12');
                $spreadsheet->getActiveSheet()->mergeCells('F11:H11');
                $spreadsheet->getActiveSheet()->mergeCells('I11:I12');
                $spreadsheet->getActiveSheet()->mergeCells('J11:J12');
                $spreadsheet->getActiveSheet()->getStyle('C8:C9')->getFont()->setBold(true);
                $spreadsheet->getActiveSheet()->getStyle('C10:J10')->getFont()->setBold(true);
                $spreadsheet->getActiveSheet()->getStyle('C11:J12')->applyFromArray($customCellMonth);
                $spreadsheet->getActiveSheet()->getStyle('I11')->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->getStyle('C8:C9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(15);
                $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(16);
                $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(11);
                for ($k=1; $k <= days_in_month($bulan_sheet,$explode[$x]) ; $k++) {
                    $set_sheet = $k+12;
                    if (strlen($k) == 1) {
                        $tanggal_cell = '0'.(string)$k;
                    }
                    else {
                        $tanggal_cell = $k;
                    }
                    $spreadsheet->getActiveSheet()->setCellValue('C'.$set_sheet,$k);
                    $spreadsheet->getActiveSheet()->setCellValue('D'.$set_sheet,get_dayname($k,$bulan_sheet,$explode[$x]));
                    $spreadsheet->getActiveSheet()->setCellValue('E'.$set_sheet,','.$tanggal_cell);
                    $spreadsheet->getActiveSheet()->setCellValue('F'.$set_sheet,BukuTamu::countByClass('X',create_date($k,$bulan_sheet,$explode[$x])));
                    $spreadsheet->getActiveSheet()->setCellValue('G'.$set_sheet,BukuTamu::countByClass('XI',create_date($k,$bulan_sheet,$explode[$x])));
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$set_sheet,BukuTamu::countByClass('XII',create_date($k,$bulan_sheet,$explode[$x])));
                    $spreadsheet->getActiveSheet()->setCellValue('I'.$set_sheet,BukuTamu::countTeacher(create_date($k,$bulan_sheet,$explode[$x])));
                    $spreadsheet->getActiveSheet()->setCellValue('J'.$set_sheet,BukuTamu::countPerDay(create_date($k,$bulan_sheet,$explode[$x])));

                    if (get_dayname($k,$bulan_sheet,$explode[$x]) == 'Minggu') {
                        $spreadsheet->getActiveSheet()->getStyle('C'.$set_sheet.':J'.$set_sheet)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');
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
                $spreadsheet->getActiveSheet()->setCellValue('F'.$cell_count,BukuTamu::countTotalByClass('X',$bulan_sheet,$explode[$x]));
                $spreadsheet->getActiveSheet()->setCellValue('G'.$cell_count,BukuTamu::countTotalByClass('XI',$bulan_sheet,$explode[$x]));
                $spreadsheet->getActiveSheet()->setCellValue('H'.$cell_count,BukuTamu::countTotalByClass('XII',$bulan_sheet,$explode[$x]));
                $spreadsheet->getActiveSheet()->setCellValue('I'.$cell_count,BukuTamu::countTotalTeacher($bulan_sheet,$explode[$x]));
                $spreadsheet->getActiveSheet()->setCellValue('J'.$cell_count,BukuTamu::countTotalAllPerMonth($bulan_sheet,$explode[$x]));
                $spreadsheet->getActiveSheet()->getStyle('C'.$cell_count)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('04d9ff');
                $spreadsheet->getActiveSheet()->getStyle('F'.$cell_count.':I'.$cell_count)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');
                $spreadsheet->getActiveSheet()->getStyle('J'.$cell_count)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('04d9ff');

                $spreadsheet->getActiveSheet()->getStyle('C13:J'.$cell_count)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle('C13:J'.$cell_count)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $styleTable = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];
                $spreadsheet->getActiveSheet()->getStyle('C11:J'.$cell_count)->applyFromArray($styleTable);

                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_sign,'Mengetahui,');
                $spreadsheet->getActiveSheet()->setCellValue('J'.$cell_sign,'Samarinda,          '.$explode[$x]);
                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_job,'Kepala Tata Administrasi');
                $spreadsheet->getActiveSheet()->setCellValue('J'.$cell_job,'Kepala Perpustakaan');
                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_name,'Jumran, S.Pd');
                $spreadsheet->getActiveSheet()->setCellValue('J'.$cell_name,'Khairul Anam, M.Pd');
                $spreadsheet->getActiveSheet()->setCellValue('C'.$cell_nip,'NIP.19660507 199011 1 001');
                $spreadsheet->getActiveSheet()->setCellValue('J'.$cell_nip,'NIP.19670512 200701 1 038');

                $spreadsheet->getActiveSheet()->getStyle('C'.$cell_name)->getFont()->setUnderline(true);
                $spreadsheet->getActiveSheet()->getStyle('C'.$cell_name.':J'.$cell_nip)->getFont()->setBold(true);
                $spreadsheet->getActiveSheet()->getSheetView()->setZoomScale(145);
                $spreadsheet->getActiveSheet()->getRowDimension('11')->setRowHeight(23);
                $spreadsheet->getActiveSheet()->getRowDimension('12')->setRowHeight(23);
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
        $drawing->setOffsetX(45);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $spreadsheet->getActiveSheet()->getSheetView()->setZoomScale(130);
        $spreadsheet->getActiveSheet()->setCellValue('D8','Rekapitulasi Jumlah Pengunjung');
        $spreadsheet->getActiveSheet()->setCellValue('D9','Perpustakaan SMK Negeri 7 Samarinda');
        $spreadsheet->getActiveSheet()->setCellValue('D10','Tahun '.$explode[1]);
        $spreadsheet->getActiveSheet()->setCellValue('D11','No.');
        $spreadsheet->getActiveSheet()->setCellValue('E11','Bulan');
        $spreadsheet->getActiveSheet()->setCellValue('F11','Jumlah Seluruh Pengunjung');
        $spreadsheet->getActiveSheet()->setCellValue('G11','Ket');

        $spreadsheet->getActiveSheet()->mergeCells('D8:G8');
        $spreadsheet->getActiveSheet()->mergeCells('D9:G9');
        $spreadsheet->getActiveSheet()->mergeCells('D10:G10');

        $styleArray = ['font'  => [
                            'bold'  => true,
                            'size'  => 14,
                            'name'  => 'Times New Roman'
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                        ]
                    ];

        $spreadsheet->getActiveSheet()->getStyle('D8:D10')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('D11:G11')->getFont()->setSize(12)->setName('Times New Roman');

        $bulan_rekap_tahun = '';
        $cell_worksheet_tahun = 12;
        for ($j=1; $j <= 12; $j++) {
            if (strlen($j) == 1) {
                $bulan_rekap_tahun = '0'.$j;
            }
            else {
                $bulan_rekap_tahun = $j;
            }
            $spreadsheet->getActiveSheet()->setCellValue('D'.$cell_worksheet_tahun,$j);
            $spreadsheet->getActiveSheet()->setCellValue('E'.$cell_worksheet_tahun,month($j));
            $spreadsheet->getActiveSheet()->setCellValue('F'.$cell_worksheet_tahun,BukuTamu::countPerYear($bulan_rekap_tahun,$explode[1]));
            $spreadsheet->getActiveSheet()->getRowDimension($cell_worksheet_tahun)->setRowHeight(18);
            $cell_worksheet_tahun = $cell_worksheet_tahun + 1;
        }
        $styleTable2 = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];
        $spreadsheet->getActiveSheet()->getStyle('D11:G24')->applyFromArray($styleTable2);
        $spreadsheet->getActiveSheet()->getStyle('D12:D23')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('F12:F23')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->setCellValue('D24','Total');
        $spreadsheet->getActiveSheet()->setCellValue('F24','=SUM(F12:F23)');
        $spreadsheet->getActiveSheet()->mergeCells('D24:E24');

        $spreadsheet->getActiveSheet()->getStyle('D24:F24')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('D24:F24')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('D11:G11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('D11:G11')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $spreadsheet->getActiveSheet()->getStyle('F11')->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle('D11:G11')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $spreadsheet->getActiveSheet()->getRowDimension('24')->setRowHeight(23);

        $spreadsheet->getActiveSheet()->setCellValue('B26','Mengetahui,');
        $spreadsheet->getActiveSheet()->setCellValue('B27','Kepala Tata Administrasi');
        $spreadsheet->getActiveSheet()->setCellValue('H26','Samarinda,          '.$explode[1]);
        $spreadsheet->getActiveSheet()->setCellValue('H27','Kepala Perpustakaan');
        $spreadsheet->getActiveSheet()->setCellValue('B31','Jumran, S.Pd');
        $spreadsheet->getActiveSheet()->setCellValue('B32','NIP.19660507 199011 1 001');
        $spreadsheet->getActiveSheet()->setCellValue('H31','Khairul Anam, M.Pd');
        $spreadsheet->getActiveSheet()->setCellValue('H32','NIP.19670512 200701 1 038');
        $spreadsheet->getActiveSheet()->getStyle('B31:H32')->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->getStyle('D11:G11')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');
        $spreadsheet->getActiveSheet()->getStyle('D24:G24')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');
        $spreadsheet->getActiveSheet()->getRowDimension('23')->setRowHeight(23);

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
}
