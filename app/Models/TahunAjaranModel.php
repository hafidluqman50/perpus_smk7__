<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaranModel extends Model
{
	protected $table      = 'tahun_ajaran';
	protected $primaryKey = 'id_tahun_ajaran';
	protected $guarded    = [];
	public $timestamps    = false;
}
