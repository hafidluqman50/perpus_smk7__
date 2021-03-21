<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratBebasPustakaModel extends Model
{
	protected $table      = 'surat_bebas_pustaka';
	protected $primaryKey = 'id_surat_bebas_pustaka';
	public $timestamps    = false;
	protected $guarded    = [];

	public static function getData()
	{
		$get = self::join('tahun_ajaran','surat_bebas_pustaka.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
					->get();

		return $get;
	}

	public static function getNomorSurat($id_tahun_ajaran)
	{
		$get = self::where('id_tahun_ajaran',$id_tahun_ajaran)->firstOrFail()->nomor_surat;

		return $get;
	}
}
