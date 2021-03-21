<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurusanModel extends Model
{
	protected $table      = 'jurusan';
	protected $primaryKey = 'id_jurusan';
	protected $guarded    = [];
	public $timestamps    = false;
}
