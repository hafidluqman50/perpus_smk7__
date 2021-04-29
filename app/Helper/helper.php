<?php 
function dua_minggu($tanggal)
{
    $dua_minggu = date('Y-m-d', strtotime('+2 week', strtotime($tanggal)));
    return $dua_minggu;
}

function mail_image($image)
{
    $link1 = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[SERVER_NAME]/public/admin-assets/dist/$image";
    $link2 = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[SERVER_NAME]/admin-assets/dist/$image";
    
    if(file_exists($link1))
    {
        return $link1;
    }
    else {
        return $link2;
    }
}

function base64_img($img)
{
    $path = getcwd().$img;
    // dd(file_exists($path));
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
}

function cari_buku()
{
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/cari";

	return $actual_link;
}

function random_number()
{
	$number = rand(100,100000);
	$t=time();
	$random = $number.''.$t;

	return $random;
}

// function random_color(){
//     mt_srand((double)microtime()*1000000);
//     $c = '';
//     while(strlen($c)<6){
//         $c .= sprintf("%02X", mt_rand(0, 255));
//     }
//     return $c;
// }

function bulan_tahun_ajaran($tahun_ajaran,$no)
{
	$bulan = [0 => ['07','08','09','10','11','12'],1 => ['01','02','03','04','05','06']];
	return $bulan[$tahun_ajaran][$no];
}

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

function unslug_str($str) {
	if (strpos($str,'-') !== false) {
		$get   = explode('-',$str);
		$words =  ucwords($get[0]).' '.ucwords($get[1]);
	}
	else {
		$words = ucwords($str);
	}

	return $words;
}

function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
        foreach( $files as $file ){
            delete_files( $file );      
        }
        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}

function explode_nama($str) {
	$nama = '';
	$explode = explode(" ",$str);
	if ($explode[0]=="M.") {
	    $nama = $explode[1];
	}
	else {
	    $nama = $explode[0];
	}
	return $nama;
}

function back_normal_date($date) {
	$date_explode = explode(' ',$date);
	return $date_explode[2].'-'.normal_month($date_explode[1]).'-'.$date_explode[0];
}

function stokBox($stok,$bobot) {
	$int  = 0;
	$bool = false;
	// while ($stok != 0) {
	// 	$stok-=$bobot-$stok;
	// 	$int+1;
	// }
	return $int;
}

function tanggal_upload($date) {
	$get = date('d M Y',strtotime($date));
	return $get;
}

function get_ket($data,$bold = false) {
	$explode = explode(' ',$data);
	if ($explode[0] == 'XII' || $explode[0] == 'XI' || $explode[0] == 'X') {
		$ket = $bold ? '<b>Kelas : </b>'.$data :  'Kelas : '.$data;
	} else {
		$ket = $data;
	}
	return $ket;
}

function date_explode($date) {
	$explode = explode('-',$date);
	return $explode[2].' '.month($explode[1]).' '.$explode[0];
}

function month($get_month) {
	if (strlen($get_month) == 1) {
		$month = '0'.(string)$get_month;
	}
	else {
		$month = $get_month;
	}
	$array = [
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	];
	return $array[$month];
}

function days_in_month($get_month,$year) {
	if (strlen($get_month) == 1) {
		$month = '0'.(string)$get_month;
	}
	else {
		$month = $get_month;
	}
	$calc = date('t', mktime(0, 0, 0, $month, 1, $year));

	return $calc;
}

function get_dayname($get_date,$get_month,$year) {
	if (strlen($get_date) == 1) {
		$date = '0'.(string)$get_date;
	}
	else {
		$date = $get_date;
	}

	if (strlen($get_month) == 1) {
		$month = '0'.(string)$get_month;
	}
	else {
		$month = $get_month;
	}

	$timestamp = strtotime($year.'-'.$month.'-'.$date);
	$day = date('l',$timestamp);

	$dayname = [
		'Monday'    => 'Senin',
		'Tuesday'   => 'Selasa',
		'Wednesday' => 'Rabu',
		'Thursday'  => 'Kamis',
		'Friday'    => 'Jum\'at',
		'Saturday'  => 'Sabtu',
		'Sunday'    => 'Minggu'
	];
	return $dayname[$day];
}

function create_date($get_date,$get_month,$year) {
	if (strlen($get_date) == 1) {
		$date = '0'.(string)$get_date;
	}
	else {
		$date = $get_date;
	}

	if (strlen($get_month) == 1) {
		$month = '0'.(string)$get_month;
	}
	else {
		$month = $get_month;
	}

	return $year.'-'.$month.'-'.$date;
}

function normal_month($month) {
	$array = [
		'Januari'   => '01',
		'Februari'  => '02',
		'Maret'     => '03',
		'April'     => '04',
		'Mei'       => '05',
		'Juni'      => '06',
		'Juli'      => '07',
		'Agustus'   => '08',
		'September' => '09',
		'Oktober'   => '10',
		'November'  => '11',
		'Desember'  => '12'
	];
	return $array[$month];
}

function denda($tanggal_awal,$tanggal_akhir) {
	$date1 = new DateTime($tanggal_awal);
	$date2 = new DateTime($tanggal_akhir);
	$days  = round(($date2->format('U') - $date1->format('U')) / (60*60*24));

	if ($days > 2) {
		if ($days % 3 == 0) {
			$bagi  = $days / 3;
			$denda = 5000 * $bagi;
		}
		else if ($days % 3 == 1) {
			$bagi  = ($days - 1) / 3;
			$denda = 5000 * $bagi;
		}
		else if ($days % 3 == 2) {
			$bagi  = ($days - 2) / 3;
			$denda = 5000 * $bagi;
		}
	}
	else {
		$denda = 0;
	}
	return $denda > 50000 ? 50000 : $denda;
}

function rupiah_format($money) {
	$hasil_rupiah = "Rp " . number_format($money,2,',','.');
	return $hasil_rupiah;
}

function kode_buku($kode) {
	$min_length = 0;
	$max_length = 100;
	$bigL       = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$smallL     = "abcdefghijklmnopqrstuvwxyz";
	$number     = "0123456789";
	$bigB       = str_shuffle($bigL);
	$smallS     = str_shuffle($smallL);
	$numberS    = str_shuffle($number);
	$subA       = substr($bigB,0,5);
	$subB       = substr($bigB,6,5);
	$subC       = substr($bigB,10,5);
	$subD       = substr($smallS,0,5);
	$subE       = substr($smallS,6,5);
	$subF       = substr($smallS,10,5);
	$subG       = substr($numberS,0,5);
	$subH       = substr($numberS,6,5);
	$subI       = substr($numberS,10,5);
	$RandCode1  = str_shuffle($subA.$subD.$subB.$subF.$subC.$subE);
	$RandCode2  = str_shuffle($RandCode1);
	$RandCode   = $RandCode1.$RandCode2;
	if ($kode > $min_length && $kode < $max_length) {
		$CodeEX = substr($RandCode,0,$kode);
	}
	else {
		$CodeEX = $RandCode;
	}
	return $CodeEX;
}