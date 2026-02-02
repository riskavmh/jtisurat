<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'letters';
    protected $fillable = [
            'ref_no',
            'user_id',
            'type',
            'lecturer_id',
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
            'excuses',
            'status',
    ];

    public function members()
    {
        return $this->hasMany(LetterMember::class);
    }
}
