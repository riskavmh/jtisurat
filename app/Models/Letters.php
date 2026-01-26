<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letters extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'letters';
    protected $fillable = [
            'user_id',
            'type',
            'lecturer',
            'course',
            'research_title',
            'to',
            'company',
            'address',
            'subdistrict',
            'regency',
            'province',
            'start_date',
            'end_date',
            'necessity',
            'note',
            'status',
    ];
}
