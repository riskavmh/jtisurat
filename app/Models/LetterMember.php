<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterMember extends Model
{

    use HasFactory, HasUuids;
    protected $table = 'letter_members';
    protected $fillable = [
            'letter_id',
            'user_id',
            'position'
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }

}
