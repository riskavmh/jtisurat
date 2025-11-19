<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'KODE_DOSEN';
    protected $keyType = 'string';
    public $incrementing = false;
}
