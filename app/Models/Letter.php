<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'letters';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
            'ref_no',
            'type_id',
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
            'excuses',
            'status',
            'scanPath',
    ];

    public function members()
    {
        return $this->hasMany(LetterMember::class, 'letter_id');
    }  
    
    public function leader()
    {
        return $this->hasOne(LetterMember::class, 'letter_id')->where('position', 'Ketua');
    }

    public function type()
    {
        return $this->belongsTo(LetterType::class, 'type_id');
    }
}
