<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'surat';
    protected $fillable = [
        'no_surat', 'nim', 'jenis', 'dosen', 'judul',
        'mata_kuliah', 'kepada', 'mitra', 'alamat',
        'kecamatan', 'kabupaten', 'provinsi',
        'start', 'end', 'kebutuhan', 'keterangan',
        'status', 'alasan',
    ];
}
