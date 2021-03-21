<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingModel extends Model
{
	protected $table      = 'rating_buku';
	protected $primaryKey = 'id_rating';
	protected $guarded    = [];
	public $timestamps    = false;
}
