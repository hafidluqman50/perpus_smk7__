<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
	protected $table      = 'kelas';
	protected $primaryKey = 'id_kelas';
	protected $guarded    = [];
	public $timestamps    = false;

	public static function showKelasSiswa()
	{
		$get = self::join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
					->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
					->whereNotIn('kelas_tingkat',['-'])
					->where('status_delete',0)
					->get();
		return $get;
	}

	public static function getData()
	{
		$get = self::join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
					->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
					->whereNotIn('kelas_tingkat',['-'])
					->where('kelas.status_delete',0)
					->get();
		return $get;
	}

	public static function getById($id)
	{
		$get = self::join('kelas_tingkat','kelas.id_kelas_tingkat','=','kelas_tingkat.id_kelas_tingkat')
					->join('jurusan','kelas.id_jurusan','=','jurusan.id_jurusan')
					->where('id_kelas',$id)
					->firstOrFail();
		return $get;	
	}
}
