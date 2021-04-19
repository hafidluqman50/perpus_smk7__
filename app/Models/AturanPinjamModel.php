<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AturanPinjamModel extends Model
{
	protected $table      = 'aturan_pinjam';
	protected $primaryKey = 'id_aturan_pinjam';
	protected $guarded    = [];
	public $timestamps    = false;
}
