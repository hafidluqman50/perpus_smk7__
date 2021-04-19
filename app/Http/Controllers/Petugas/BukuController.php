<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BukuModel as Buku;
use App\Models\KategoriModel as Kategori;
use App\Models\SubKategoriModel as SubKategori;
use App\Models\BarcodeModel as Barcode;
use Intervention\Image\ImageManagerStatic as Image;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Str;
use Zip;

class BukuController extends Controller
{
    public function index() 
    {
        $title = 'Data Buku | Petugas';
        $buku  = 'menu-open';
        $page  = 'data-buku';
        return view('Pengurus.Petugas.page.buku.data-buku.main',compact('title','buku','page'));
    }

    public function tambah() 
    {
        $title    = 'Form Buku | Petugas';
        $buku     = 'menu-open';
        $page     = 'data-buku';
        $kategori = Kategori::all();
        return view('Pengurus.Petugas.page.buku.data-buku.form-buku',compact('title','buku','page','kategori'));
    }

    public function edit($id) 
    {
        $title    = 'Form Buku | Petugas';
        $buku     = 'menu-open';
        $page     = 'data-buku';
        $row      = Buku::getData($id);
        $kategori = Kategori::all();
        $sub_ktg  = new SubKategori;
        return view('Pengurus.Petugas.page.buku.data-buku.form-buku',compact('title','buku','page','kategori','sub_ktg','row'));   
    }

    public function delete($id) 
    {
        $get = Buku::where('id_buku',$id);
        $foto = $get->firstOrFail()->foto_buku;
        if (file_exists(public_path('front-assets/foto_buku/'.$foto))) {
            unlink(public_path('front-assets/foto_buku/'.$foto));
        }
        $get->delete();
        Barcode::where('id_buku',$id)->delete();

        return redirect('/petugas/data-buku')->with('message','Berhasil Hapus Buku');
    }

    public function save(Request $request) 
    {
        if (Buku::count() == 0) {
            $nomor_induk = 1;
        } else {
            $nomor_induk = Buku::orderBy('id_buku','desc')->firstOrFail()->nomor_induk+1;
        }
        $judul_buku       = $request->judul_buku;
        $judul_slug       = Str::slug($judul_buku,'-');
        $sub_ktg          = $request->sub_ktg;
        $inisial_buku     = $request->inisial_buku;
        $pengarang        = $request->pengarang;
        $penerbit         = $request->penerbit;
        $tahun_terbit     = $request->tahun_terbit;
        $tempat_terbit    = $request->tempat_terbit;
        $tahun_buku       = $request->tahun_buku;
        $sn_penulis       = $request->sn_penulis;
        $jumlah_eksemplar = $request->jumlah_eksemplar;
        $klasifikasi      = $request->klasifikasi;
        $stok_buku        = $request->stok_buku;
        $foto_buku        = $request->foto_buku;
        $fileName         = $foto_buku != '' ?uniqid('_foto_buku_').$foto_buku->getClientOriginalName():'-';
        $keterangan       = $request->keterangan;
        $jenis_buku       = $request->jenis_buku;
        $id               = $request->id_buku;
        if ($id == '') {
            if ($foto_buku != '') {
                Image::make($foto_buku)->resize(446,446)->save('front-assets/foto_buku/'.$fileName);
            }
            $array = [
                'tanggal_upload'   => date('Y-m-d'),
                'judul_buku'       => $judul_buku,
                'judul_slug'       => $judul_slug,
                'inisial_buku'     => $inisial_buku,
                'pengarang'        => $pengarang,
                'sn_penulis'       => $sn_penulis,
                'penerbit'         => $penerbit,
                'tempat_terbit'    => $tempat_terbit,
                'tahun_terbit'     => $tahun_terbit,
                'tahun_buku'       => $tahun_buku,
                'id_sub_ktg'       => $sub_ktg,
                'klasifikasi'      => $klasifikasi,
                'jumlah_eksemplar' => $jumlah_eksemplar,
                'stok_buku'        => $stok_buku,
                'foto_buku'        => $fileName,
                'keterangan'       => $keterangan,
                'jenis_buku'       => $jenis_buku
            ];
            Buku::create($array);
            for ($i=0; $i < $stok_buku; $i++) { 
                $id_buku = Buku::where('judul_slug',$judul_slug)->firstOrFail()->id_buku;
                $data_barcode = [
                    'id_barcode'   => (string) Str::uuid(),
                    'code_scanner' => random_number(),
                    'id_buku'      => $id_buku,
                ];

                Barcode::firstOrCreate($data_barcode);
            }
            $message = 'Berhasil Input Buku';
        } else {

            if ($foto_buku != '') {
                $foto = Buku::where('id_buku',$id)->firstOrFail()->foto_buku;
                
                if (file_exists(public_path('front-assets/foto_buku/'.$foto))) {
                    unlink(public_path('front-assets/foto_buku/'.$foto));
                }

                Image::make($foto_buku)->resize(446,446)->save('front-assets/foto_buku/'.$fileName);
                $array = [
                    'tanggal_upload'   => date('Y-m-d'),
                    'judul_buku'       => $judul_buku,
                    'judul_slug'       => $judul_slug,
                    'inisial_buku'     => $inisial_buku,
                    'pengarang'        => $pengarang,
                    'sn_penulis'       => $sn_penulis,
                    'penerbit'         => $penerbit,
                    'tempat_terbit'    => $tempat_terbit,
                    'tahun_terbit'     => $tahun_terbit,
                    'tahun_buku'       => $tahun_buku,
                    'id_sub_ktg'       => $sub_ktg,
                    'klasifikasi'      => $klasifikasi,
                    'jumlah_eksemplar' => $jumlah_eksemplar,
                    'stok_buku'        => $stok_buku,
                    'foto_buku'        => $fileName,
                    'keterangan'       => $keterangan,
                    'jenis_buku'       => $jenis_buku
                ];
            }
            else {
                $array = [
                    'tanggal_upload'   => date('Y-m-d'),
                    'judul_buku'       => $judul_buku,
                    'judul_slug'       => $judul_slug,
                    'inisial_buku'     => $inisial_buku,
                    'pengarang'        => $pengarang,
                    'sn_penulis'       => $sn_penulis,
                    'penerbit'         => $penerbit,
                    'tempat_terbit'    => $tempat_terbit,
                    'tahun_terbit'     => $tahun_terbit,
                    'tahun_buku'       => $tahun_buku,
                    'id_sub_ktg'       => $sub_ktg,
                    'klasifikasi'      => $klasifikasi,
                    'jumlah_eksemplar' => $jumlah_eksemplar,
                    'stok_buku'        => $stok_buku,
                    'keterangan'       => $keterangan,
                    'jenis_buku'       => $jenis_buku
                ];
            }

            if (Buku::where('id_buku',$id)->firstOrFail()->stok_buku != $stok_buku) {
                Barcode::where('id_buku',$id)->delete();

                for ($j=0; $j < $stok_buku; $j++) {
                    $data_barcode = [
                        'id_barcode'   => (string) Str::uuid(),
                        'code_scanner' => random_number(),
                        'id_buku'      => $id,
                    ];

                    Barcode::firstOrCreate($data_barcode);
                }
            }

            Buku::where('id_buku',$id)->update($array);
            $message = 'Berhasil Update Buku';
        }
        return redirect('/petugas/data-buku')->with('message',$message);
    }

    public function contohImport()
    {
        $fileName    = 'Contoh Format Import Buku.xlsx';
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $spreadsheet->getDefaultStyle()->getFont()->setSize('12');

        $spreadsheet->getActiveSheet()->setCellValue('A1','No.');
        $spreadsheet->getActiveSheet()->setCellValue('B1','Judul Buku');
        $spreadsheet->getActiveSheet()->setCellValue('C1','Inisial Buku');
        $spreadsheet->getActiveSheet()->setCellValue('D1','Tahun Buku');
        $spreadsheet->getActiveSheet()->setCellValue('E1','Pengarang');
        $spreadsheet->getActiveSheet()->setCellValue('F1','Singkatan Penulis');
        $spreadsheet->getActiveSheet()->setCellValue('G1','Penerbit');
        $spreadsheet->getActiveSheet()->setCellValue('H1','Tempat Terbit');
        $spreadsheet->getActiveSheet()->setCellValue('I1','Tahun Terbit');
        $spreadsheet->getActiveSheet()->setCellValue('J1','Kategori');
        $spreadsheet->getActiveSheet()->setCellValue('K1','Sub Kategori');
        $spreadsheet->getActiveSheet()->setCellValue('L1','Klasifikasi');
        $spreadsheet->getActiveSheet()->setCellValue('M1','Jumlah Eksemplar');
        $spreadsheet->getActiveSheet()->setCellValue('N1','Stok Buku');
        $spreadsheet->getActiveSheet()->setCellValue('O1','Keterangan');
        $spreadsheet->getActiveSheet()->setCellValue('P1','Foto Buku');

        $spreadsheet->getActiveSheet()->setCellValue('A2','1');
        $spreadsheet->getActiveSheet()->setCellValue('B2','Buku Sakti Pemrograman Web: HTML, CSS, PHP, MySQL & Javascript');
        $spreadsheet->getActiveSheet()->setCellValue('C2','B');
        $spreadsheet->getActiveSheet()->setCellValue('D2','2018');
        $spreadsheet->getActiveSheet()->setCellValue('E2','Didik Setiawan');
        $spreadsheet->getActiveSheet()->setCellValue('F2','DSN');
        $spreadsheet->getActiveSheet()->setCellValue('G2','Gramedia');
        $spreadsheet->getActiveSheet()->setCellValue('H2','Jakarta');
        $spreadsheet->getActiveSheet()->setCellValue('I2','2017');
        $spreadsheet->getActiveSheet()->setCellValue('J2','referensi');
        $spreadsheet->getActiveSheet()->setCellValue('K2','rekayasa-perangkat-lunak');
        $spreadsheet->getActiveSheet()->setCellValue('L2','001.002.003');
        $spreadsheet->getActiveSheet()->setCellValue('M2','1000');
        $spreadsheet->getActiveSheet()->setCellValue('N2','100');
        $spreadsheet->getActiveSheet()->setCellValue('O2','-');
        $spreadsheet->getActiveSheet()->setCellValue('P2','000.png');

        $spreadsheet->getActiveSheet()->setCellValue('A3','2');
        $spreadsheet->getActiveSheet()->setCellValue('B3','PHP untuk Programmer Pemula');
        $spreadsheet->getActiveSheet()->setCellValue('C3','P');
        $spreadsheet->getActiveSheet()->setCellValue('D3','2018');
        $spreadsheet->getActiveSheet()->setCellValue('E3','Jubilee Enterprise');
        $spreadsheet->getActiveSheet()->setCellValue('F3','JEN');
        $spreadsheet->getActiveSheet()->setCellValue('G3','Elex Media Computindo');
        $spreadsheet->getActiveSheet()->setCellValue('H3','Jakarta');
        $spreadsheet->getActiveSheet()->setCellValue('I3','2017');
        $spreadsheet->getActiveSheet()->setCellValue('J3','referensi');
        $spreadsheet->getActiveSheet()->setCellValue('K3','rekayasa-perangkat-lunak');
        $spreadsheet->getActiveSheet()->setCellValue('L3','001.002.004');
        $spreadsheet->getActiveSheet()->setCellValue('M3','1000');
        $spreadsheet->getActiveSheet()->setCellValue('N3','100');
        $spreadsheet->getActiveSheet()->setCellValue('O3','-');
        $spreadsheet->getActiveSheet()->setCellValue('P3','dibawahumur.jpg');

        $spreadsheet->getActiveSheet()->setCellValue('A4','3');
        $spreadsheet->getActiveSheet()->setCellValue('B4','PHP Komplet');
        $spreadsheet->getActiveSheet()->setCellValue('C4','P');
        $spreadsheet->getActiveSheet()->setCellValue('D4','2018');
        $spreadsheet->getActiveSheet()->setCellValue('E4','Jubilee Enterprise');
        $spreadsheet->getActiveSheet()->setCellValue('F4','JEN');
        $spreadsheet->getActiveSheet()->setCellValue('G4','Elex Media Computindo');
        $spreadsheet->getActiveSheet()->setCellValue('H4','Jakarta');
        $spreadsheet->getActiveSheet()->setCellValue('I4','2017');
        $spreadsheet->getActiveSheet()->setCellValue('J4','referensi');
        $spreadsheet->getActiveSheet()->setCellValue('K4','rekayasa-perangkat-lunak');
        $spreadsheet->getActiveSheet()->setCellValue('L4','001.002.005');
        $spreadsheet->getActiveSheet()->setCellValue('M4','1000');
        $spreadsheet->getActiveSheet()->setCellValue('N4','100');
        $spreadsheet->getActiveSheet()->setCellValue('O4','-');
        $spreadsheet->getActiveSheet()->setCellValue('P4','eff5265063ca252d8bfdb0bbe1963b11.jpeg');

        $styleAlignment = [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]];

        $spreadsheet->getActiveSheet()->getStyle('A1:N4')->applyFromArray($styleAlignment);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        $writer->save('php://output');
    }

    public function importBuku() 
    {
        $title = 'Import Buku';
        $page  = 'data-buku';
        $buku  = 'menu-open';

        return view('Pengurus.Petugas.page.buku.data-buku.import-buku',compact('title','page','buku'));
    }

    public function importPost(Request $request) 
    {
        $fileBuku    = $request->file_buku;
        $fotoBuku    = $request->foto_buku;

        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($fileBuku);

        foreach ($reader->getSheetIterator() as $sheet) {
            if ($sheet->getIndex() === 0) {
                foreach ($sheet->getRowIterator() as $num => $row) {
                    if ($num > 1) {
                        $cells = $row->getCells();
                        $data_buku = [
                            'tanggal_upload'   => date('Y-m-d'),
                            'judul_buku'       => $cells[1]->getValue(),
                            'judul_slug'       => Str::slug($cells[1]->getValue(),'-'),
                            'inisial_buku'     => $cells[2]->getValue(),
                            'tahun_buku'       => $cells[3]->getValue(),
                            'pengarang'        => $cells[4]->getValue(),
                            'sn_penulis'       => $cells[5]->getValue(),
                            'penerbit'         => $cells[6]->getValue(),
                            'tempat_terbit'    => $cells[7]->getValue(),
                            'tahun_terbit'     => $cells[8]->getValue(),
                            'id_sub_ktg'       => SubKategori::getIdSubKtg($cells[9]->getValue(),$cells[10]->getValue()),
                            'klasifikasi'      => $cells[11]->getValue(),
                            'jumlah_eksemplar' => $cells[12]->getValue(),
                            'stok_buku'        => $cells[13]->getValue(),
                            'foto_buku'        => $cells[15]->getValue(),
                            'keterangan'       => $cells[14]->getValue(),
                        ];
                        Buku::firstOrCreate($data_buku);
                        for ($i=0; $i < $cells[13]->getValue(); $i++) {
                            $id_buku = Buku::where('judul_slug',Str::slug($cells[1]->getValue(),'-'))->firstOrFail()->id_buku;

                            Barcode::where('id_buku',$id_buku)->delete();

                            $data_barcode = [
                                'id_barcode'   => (string) Str::uuid(),
                                'code_scanner' => random_number(),
                                'id_buku'      => $id_buku,
                            ];

                            Barcode::firstOrCreate($data_barcode);
                        }
                    }
                }
            }
        }

        $reader->close();

        $zip = Zip::open($fotoBuku);
        $zip->extract(public_path('/extract_zip'));
        $zip->close();

        $scandir = glob(public_path('/extract_zip').'/*.{jpeg,gif,png,jpg}',GLOB_BRACE);

        for ($i=0; $i < count($scandir); $i++) {
            $explode = explode('/var/www/perpus_smk7/public/extract_zip/',$scandir[$i]);
            Image::make($scandir[$i])->resize(446,446)->save('front-assets/foto_buku/'.$explode[1]);
        }

        delete_files(public_path('/extract_zip/'));

        return redirect('/petugas/data-buku')->with('message','Berhasil Import Buku');
    }
    
    public function cetakLaporan(Request $request) 
    {   
        $title       = str_replace('/',' - ',$request->tahun_ajaran);
        $fileName    = 'Daftar Buku Tahun '.$title.'.xlsx';
        $spreadsheet = new Spreadsheet();

        $setStyleAlignment = [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]
                    ];
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $spreadsheet->getDefaultStyle()->getFont()->setSize('12');

        $spreadsheet->setActiveSheetIndex(0)->setTitle('Daftar Buku');
        $spreadsheet->getActiveSheet()->setCellValue('A1','NO.');
        $spreadsheet->getActiveSheet()->setCellValue('B1','JUDUL');
        $spreadsheet->getActiveSheet()->setCellValue('C1','PENGARANG');
        $spreadsheet->getActiveSheet()->setCellValue('D1','SINGKATAN NAMA PENGARANG');
        $spreadsheet->getActiveSheet()->setCellValue('E1','TEMPAT TERBIT');
        $spreadsheet->getActiveSheet()->setCellValue('F1','PENERBIT');
        $spreadsheet->getActiveSheet()->setCellValue('G1','TAHUN TERBIT');
        $spreadsheet->getActiveSheet()->setCellValue('H1','TAHUN BUKU');
        $spreadsheet->getActiveSheet()->setCellValue('I1','NOMOR KLASIFIKASI');
        $spreadsheet->getActiveSheet()->setCellValue('J1','INISIAL BUKU');
        $spreadsheet->getActiveSheet()->setCellValue('K1','NOMOR INDUK');
        $spreadsheet->getActiveSheet()->setCellValue('M1','JUMLAH EKSEMPLAR');
        $spreadsheet->getActiveSheet()->setCellValue('O1','KETERANGAN');
        $spreadsheet->getActiveSheet()->setCellValue('O2','JENIS BUKU');
        $spreadsheet->getActiveSheet()->setCellValue('P2','CATATAN');

        $spreadsheet->getActiveSheet()->getStyle('A1:P2')->getFont()->setSize(14);
        $spreadsheet->getActiveSheet()->getStyle('A1:P2')->getFont()->setBold(true);

        $spreadsheet->getActiveSheet()->mergeCells('A1:A2');
        $spreadsheet->getActiveSheet()->mergeCells('B1:B2');
        $spreadsheet->getActiveSheet()->mergeCells('C1:C2');
        $spreadsheet->getActiveSheet()->mergeCells('D1:D2');
        $spreadsheet->getActiveSheet()->mergeCells('E1:E2');
        $spreadsheet->getActiveSheet()->mergeCells('F1:F2');
        $spreadsheet->getActiveSheet()->mergeCells('G1:G2');
        $spreadsheet->getActiveSheet()->mergeCells('H1:H2');
        $spreadsheet->getActiveSheet()->mergeCells('I1:I2');
        $spreadsheet->getActiveSheet()->mergeCells('J1:J2');
        $spreadsheet->getActiveSheet()->mergeCells('K1:L2');
        $spreadsheet->getActiveSheet()->mergeCells('M1:N2');
        $spreadsheet->getActiveSheet()->mergeCells('O1:P1');
        
        $spreadsheet->getActiveSheet()->getStyle('A1:P2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C8C8C8');

        $spreadsheet->getActiveSheet()->getStyle('D1')->getAlignment()->setWrapText(true);

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(22);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(18);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(28);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(14);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(14);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(30);
        $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(75);
        $spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(21);

        $sheet_buku      = 3;
        $sheet_merge     = 0;
        $sheet_merge_end = 0;
        $nomor_urut      = 1;

        $explode = explode('/',$request->tahun_ajaran);

        $buku = Buku::showData();
        foreach ($buku as $key => $value) {
            $sheet_merge = $sheet_buku;
            for ($i=1; $i <= $value->jumlah_eksemplar; $i++) { 
                $spreadsheet->getActiveSheet()->setCellValue('A'.$sheet_buku,$nomor_urut);
                $spreadsheet->getActiveSheet()->setCellValue('B'.$sheet_buku,$value->judul_buku);
                $spreadsheet->getActiveSheet()->setCellValue('C'.$sheet_buku,$value->pengarang);
                $spreadsheet->getActiveSheet()->setCellValue('D'.$sheet_buku,$value->sn_penulis);
                $spreadsheet->getActiveSheet()->setCellValue('E'.$sheet_buku,$value->tempat_terbit);
                $spreadsheet->getActiveSheet()->setCellValue('F'.$sheet_buku,$value->penerbit);
                $spreadsheet->getActiveSheet()->setCellValue('G'.$sheet_buku,$value->tahun_terbit);
                $spreadsheet->getActiveSheet()->setCellValue('H'.$sheet_buku,$value->tahun_buku);
                $spreadsheet->getActiveSheet()->setCellValue('I'.$sheet_buku,$value->klasifikasi);
                $spreadsheet->getActiveSheet()->setCellValue('J'.$sheet_buku,$value->inisial_buku);
                $spreadsheet->getActiveSheet()->setCellValue('K'.$sheet_buku,$nomor_urut);
                $spreadsheet->getActiveSheet()->setCellValue('L'.$sheet_buku,'/SMKN7/P.'.$explode[0]);
                $spreadsheet->getActiveSheet()->setCellValue('O'.$sheet_buku,$value->nama_kategori.'('.$value->nama_sub.')');
                $spreadsheet->getActiveSheet()->setCellValue('P'.$sheet_buku,'');

                $nomor_urut = $nomor_urut+1;
                $sheet_buku = $sheet_buku+1;
            }
            $sheet_merge_end = $sheet_buku - 1;
            $spreadsheet->getActiveSheet()->setCellValue('M'.$sheet_merge,$value->jumlah_eksemplar.' Buku');
            $spreadsheet->getActiveSheet()->getStyle('M'.$sheet_merge)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('M'.$sheet_merge)->getFont()->setSize(28);
            $spreadsheet->getActiveSheet()->mergeCells('M'.$sheet_merge.':N'.$sheet_merge_end);
            $spreadsheet->getActiveSheet()->getStyle('A'.$sheet_merge.':O'.$sheet_merge_end)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB(random_color());
        }


        $styleTable = ['borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];
        $spreadsheet->getActiveSheet()->getStyle('A1:P'.$sheet_buku)->applyFromArray($styleTable);
        $spreadsheet->getActiveSheet()->getStyle('A1:P'.$sheet_buku)->applyFromArray($setStyleAlignment);
        $spreadsheet->getActiveSheet()->setCellValue('A'.$sheet_buku,'TOTAL BUKU ( HITUNGAN EKSEMPLAR )');
        $spreadsheet->getActiveSheet()->setCellValue('M'.$sheet_buku,$nomor_urut);
        $spreadsheet->getActiveSheet()->mergeCells('A'.$sheet_buku.':L'.$sheet_buku);
        $spreadsheet->getActiveSheet()->mergeCells('M'.$sheet_buku.':N'.$sheet_buku);
        $spreadsheet->getActiveSheet()->getStyle('A'.$sheet_buku.':M'.$sheet_buku)->getFont()->setSize(20);
        $spreadsheet->getActiveSheet()->getRowDimension($sheet_buku)->setRowHeight(45);
        $spreadsheet->getActiveSheet()->getStyle('A'.$sheet_buku.':L'.$sheet_buku)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3498db');

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        $writer->save('php://output');
    }

    public function cetakLabel()
    {
        $buku = Buku::all();

        return view('Pengurus.Petugas.page.buku.data-buku.cetak-label',compact('buku'));
    }

    public function cetakLabelById($id)
    {
        $buku = Buku::where('id_buku',$id)->get();

        return view('Pengurus.Petugas.page.buku.data-buku.cetak-label',compact('buku'));
    }

    public function cetakBarcode()
    {
        $buku    = Buku::all();
        $barcode = new Barcode;

        return view('Pengurus.Petugas.page.buku.data-buku.cetak-barcode',compact('buku','barcode'));
    }

    public function cetakBarcodeById($id)
    {
        $buku    = Buku::where('id_buku',$id)->get();
        $barcode = new Barcode;

        return view('Pengurus.Petugas.page.buku.data-buku.cetak-barcode',compact('buku','barcode'));
    }
}
