<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinBukuTamuModel extends Model
{
    protected $table      = 'pin_buku_tamu';
    protected $primaryKey = 'id_pin_buku_tamu';
    protected $guarded    = [];
    public $timestamps    = false;
}
