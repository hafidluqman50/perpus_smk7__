<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BukuModel as Buku;
use App\Models\KategoriModel as Kategori;
use App\Models\SubKategoriModel as SubKategori;
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
        $title = 'Data Buku | Admin';
        $buku  = 'menu-open';
        $page  = 'data-buku';
        return view('Pengurus.Admin.page.buku.data-buku.main',compact('title','buku','page'));
    }

    public function tambah() 
    {
        $title    = 'Form Buku | Admin';
        $buku     = 'menu-open';
        $page     = 'data-buku';
        $kategori = Kategori::all();
        return view('Pengurus.Admin.page.buku.data-buku.form-buku',compact('title','buku','page','kategori'));
    }

    public function edit($id) 
    {
        $title    = 'Form Buku | Admin';
        $buku     = 'menu-open';
        $page     = 'data-buku';
        $row      = Buku::getData($id);
        $kategori = Kategori::all();
        $sub_ktg  = new SubKategori;
        return view('Pengurus.Admin.page.buku.data-buku.form-buku',compact('title','buku','page','kategori','sub_ktg','row'));   
    }

    public function delete($id) 
    {
        $get = Buku::where('id_buku',$id);
        $foto = $get->firstOrFail()->foto_buku;
        if (file_exists(public_path('front-assets/foto_buku/'.$foto))) {
            unlink(public_path('front-assets/foto_buku/'.$foto));
        }
        $get->delete();
        return redirect('/admin/data-buku')->with('message','Berhasil Hapus Buku');
    }

    public function save(Request $request) 
    {
        if (Buku::count() == 0) {
            $nomor_induk = 1;
        } else {
            $nomor_induk = Buku::orderBy('id_buku','desc')->firstOrFail()->nomor_induk+1;
        }
        $judul_buku       = $request->judul_buku;
        $judul_slug       = str_slug($judul_buku,'-');
        $sub_ktg          = $request->sub_ktg;
        $pengarang        = $request->pengarang;
        $penerbit         = $request->penerbit;
        $tahun_terbit     = $request->tahun_terbit;
        $tempat_terbit    = $request->tempat_terbit;
        $sn_penulis       = $request->sn_penulis;
        $jumlah_eksemplar = $request->jumlah_eksemplar;
        $klasifikasi      = $request->klasifikasi;
        $stok_buku        = $request->stok_buku;
        $foto_buku        = $request->foto_buku;
        $fileName         = $foto_buku != '' ?uniqid('_foto_buku_').$foto_buku->getClientOriginalName():'-';
        $keterangan       = $request->keterangan;
        $id               = $request->id_buku;
        if ($id == '') {
            if ($foto_buku != '') {
                Image::make($foto_buku)->resize(446,446)->save('front-assets/foto_buku/'.$fileName);
            }
            $array = [
                'tanggal_upload'   => date('Y-m-d'),
                'nomor_induk'      => $nomor_induk,
                'judul_buku'       => $judul_buku,
                'judul_slug'       => $judul_slug,
                'pengarang'        => $pengarang,
                'sn_penulis'       => $sn_penulis,
                'penerbit'         => $penerbit,
                'tempat_terbit'    => $tempat_terbit,
                'tahun_terbit'     => $tahun_terbit,
                'id_sub_ktg'       => $sub_ktg,
                'klasifikasi'      => $klasifikasi,
                'jumlah_eksemplar' => $jumlah_eksemplar,
                'stok_buku'        => $stok_buku,
                'foto_buku'        => $fileName,
                'keterangan'       => $keterangan
            ];
            Buku::create($array);
            $message = 'Berhasil Input Buku';
        } else {
            $get = Buku::where('id_buku',$id);
            if ($foto_buku != '') {
                $foto = $get->firstOrFail()->foto_buku;
                if (file_exists(public_path('front-assets/foto_buku/'.$foto))) {
                    unlink(public_path('front-assets/foto_buku/'.$foto));
                }
                Image::make($foto_buku)->resize(446,446)->save('front-assets/foto_buku/'.$fileName);
                $array = [
                    'tanggal_upload'   => date('Y-m-d'),
                    'nomor_induk'      => $nomor_induk,
                    'judul_buku'       => $judul_buku,
                    'judul_slug'       => $judul_slug,
                    'pengarang'        => $pengarang,
                    'sn_penulis'       => $sn_penulis,
                    'penerbit'         => $penerbit,
                    'tempat_terbit'    => $tempat_terbit,
                    'tahun_terbit'     => $tahun_terbit,
                    'id_sub_ktg'       => $sub_ktg,
                    'klasifikasi'      => $klasifikasi,
                    'jumlah_eksemplar' => $jumlah_eksemplar,
                    'stok_buku'        => $stok_buku,
                    'foto_buku'        => $fileName,
                    'keterangan'       => $keterangan
                ];
            }
            else {
                $array = [
                    'tanggal_upload'   => date('Y-m-d'),
                    'nomor_induk'      => $nomor_induk,
                    'judul_buku'       => $judul_buku,
                    'judul_slug'       => $judul_slug,
                    'pengarang'        => $pengarang,
                    'sn_penulis'       => $sn_penulis,
                    'penerbit'         => $penerbit,
                    'tempat_terbit'    => $tempat_terbit,
                    'tahun_terbit'     => $tahun_terbit,
                    'id_sub_ktg'       => $sub_ktg,
                    'klasifikasi'      => $klasifikasi,
                    'jumlah_eksemplar' => $jumlah_eksemplar,
                    'stok_buku'        => $stok_buku,
                    'keterangan'       => $keterangan
                ];
            }
            $get->update($array);
            $message = 'Berhasil Update Buku';
        }
        return redirect('/admin/data-buku')->with('message',$message);
    }

    public function contohImport()
    {
        $fileName    = 'Contoh Format Import Buku.xlsx';
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $spreadsheet->getDefaultStyle()->getFont()->setSize('12');

        $spreadsheet->getActiveSheet()->setCellValue('A1','No.');
        $spreadsheet->getActiveSheet()->setCellValue('B1','Judul Buku');
        $spreadsheet->getActiveSheet()->setCellValue('C1','Pengarang');
        $spreadsheet->getActiveSheet()->setCellValue('D1','Singkatan Penulis');
        $spreadsheet->getActiveSheet()->setCellValue('E1','Penerbit');
        $spreadsheet->getActiveSheet()->setCellValue('F1','Tempat Terbit');
        $spreadsheet->getActiveSheet()->setCellValue('G1','Tahun Terbit');
        $spreadsheet->getActiveSheet()->setCellValue('H1','Kategori');
        $spreadsheet->getActiveSheet()->setCellValue('I1','Sub Kategori');
        $spreadsheet->getActiveSheet()->setCellValue('J1','Klasifikasi');
        $spreadsheet->getActiveSheet()->setCellValue('K1','Jumlah Eksemplar');
        $spreadsheet->getActiveSheet()->setCellValue('L1','Stok Buku');
        $spreadsheet->getActiveSheet()->setCellValue('M1','Keterangan');
        $spreadsheet->getActiveSheet()->setCellValue('N1','Foto Buku');

        $spreadsheet->getActiveSheet()->setCellValue('A2','1');
        $spreadsheet->getActiveSheet()->setCellValue('B2','Buku Sakti Pemrograman Web: HTML, CSS, PHP, MySQL & Javascript');
        $spreadsheet->getActiveSheet()->setCellValue('C2','Didik Setiawan');
        $spreadsheet->getActiveSheet()->setCellValue('D2','DSN');
        $spreadsheet->getActiveSheet()->setCellValue('E2','Gramedia');
        $spreadsheet->getActiveSheet()->setCellValue('F2','Jakarta');
        $spreadsheet->getActiveSheet()->setCellValue('G2','2017');
        $spreadsheet->getActiveSheet()->setCellValue('H2','referensi');
        $spreadsheet->getActiveSheet()->setCellValue('I2','rekayasa-perangkat-lunak');
        $spreadsheet->getActiveSheet()->setCellValue('J2','001.002.003');
        $spreadsheet->getActiveSheet()->setCellValue('K2','1000');
        $spreadsheet->getActiveSheet()->setCellValue('L2','100');
        $spreadsheet->getActiveSheet()->setCellValue('M2','-');
        $spreadsheet->getActiveSheet()->setCellValue('N2','000.png');

        $spreadsheet->getActiveSheet()->setCellValue('A3','2');
        $spreadsheet->getActiveSheet()->setCellValue('B3','PHP untuk Programmer Pemula');
        $spreadsheet->getActiveSheet()->setCellValue('C3','Jubilee Enterprise');
        $spreadsheet->getActiveSheet()->setCellValue('D3','JEN');
        $spreadsheet->getActiveSheet()->setCellValue('E3','Elex Media Computindo');
        $spreadsheet->getActiveSheet()->setCellValue('F3','Jakarta');
        $spreadsheet->getActiveSheet()->setCellValue('G3','2017');
        $spreadsheet->getActiveSheet()->setCellValue('H3','referensi');
        $spreadsheet->getActiveSheet()->setCellValue('I3','rekayasa-perangkat-lunak');
        $spreadsheet->getActiveSheet()->setCellValue('J3','001.002.004');
        $spreadsheet->getActiveSheet()->setCellValue('K3','1000');
        $spreadsheet->getActiveSheet()->setCellValue('L3','100');
        $spreadsheet->getActiveSheet()->setCellValue('M3','-');
        $spreadsheet->getActiveSheet()->setCellValue('N3','dibawahumur.jpg');

        $spreadsheet->getActiveSheet()->setCellValue('A4','3');
        $spreadsheet->getActiveSheet()->setCellValue('B4','PHP Komplet');
        $spreadsheet->getActiveSheet()->setCellValue('C4','Jubilee Enterprise');
        $spreadsheet->getActiveSheet()->setCellValue('D4','JEN');
        $spreadsheet->getActiveSheet()->setCellValue('E4','Elex Media Computindo');
        $spreadsheet->getActiveSheet()->setCellValue('F4','Jakarta');
        $spreadsheet->getActiveSheet()->setCellValue('G4','2017');
        $spreadsheet->getActiveSheet()->setCellValue('H4','referensi');
        $spreadsheet->getActiveSheet()->setCellValue('I4','rekayasa-perangkat-lunak');
        $spreadsheet->getActiveSheet()->setCellValue('J4','001.002.005');
        $spreadsheet->getActiveSheet()->setCellValue('K4','1000');
        $spreadsheet->getActiveSheet()->setCellValue('L4','100');
        $spreadsheet->getActiveSheet()->setCellValue('M4','-');
        $spreadsheet->getActiveSheet()->setCellValue('N4','eff5265063ca252d8bfdb0bbe1963b11.jpeg');

        $styleAlignment = [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]];

        $spreadsheet->getActiveSheet()->getStyle('A1:N4')->applyFromArray($styleAlignment);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(8);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(21);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(11);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(9);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(9);

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

        return view('Pengurus.Admin.page.buku.data-buku.import-buku',compact('title','page','buku'));
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
                        $data_buku[] = [
                            'tanggal_upload'   => date('Y-m-d'),
                            'nomor_induk'      => 0,
                            'judul_buku'       => $cells[1]->getValue(),
                            'judul_slug'       => Str::slug($cells[1]->getValue(),'-'),
                            'pengarang'        => $cells[2]->getValue(),
                            'sn_penulis'       => $cells[3]->getValue(),
                            'penerbit'         => $cells[4]->getValue(),
                            'tempat_terbit'    => $cells[5]->getValue(),
                            'tahun_terbit'     => $cells[6]->getValue(),
                            'id_sub_ktg'       => SubKategori::getIdSubKtg($cells[7]->getValue(),$cells[8]->getValue()),
                            'klasifikasi'      => $cells[9]->getValue(),
                            'jumlah_eksemplar' => $cells[10]->getValue(),
                            'stok_buku'        => $cells[11]->getValue(),
                            'foto_buku'        => $cells[13]->getValue(),
                            'keterangan'       => $cells[12]->getValue(),
                        ];
                    }
                }
            }
        }

        $reader->close();

        Buku::insert($data_buku);

        $zip = Zip::open($fotoBuku);
        $zip->extract(public_path('/extract_zip'));
        $zip->close();

        $scandir = glob(public_path('/extract_zip').'/*.{jpeg,gif,png,jpg}',GLOB_BRACE);

        for ($i=0; $i < count($scandir); $i++) {
            $explode = explode('/var/www/perpus_smk7/public/extract_zip/',$scandir[$i]);
            Image::make($scandir[$i])->resize(446,446)->save('front-assets/foto_buku/'.$explode[1]);
        }

        delete_files(public_path('/extract_zip/'));

        return redirect('/admin/data-buku')->with('message','Berhasil Import Buku');
    }
    
    public function cetakLaporan() 
    {
        
    }
}
