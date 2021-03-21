<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasTingkatModel extends Model
{
	protected $table      = 'kelas_tingkat';
	protected $primaryKey = 'id_kelas_tingkat';
	protected $guarded    = [];
	public $timestamps    = false;
}
