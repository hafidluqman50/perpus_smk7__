<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanduanPinjamModel extends Model
{
	protected $table      = 'panduan_pinjam';
	protected $primaryKey = 'id_panduan_pinjam';
	protected $guarded    = [];
	public $timestamps    = false;
}
