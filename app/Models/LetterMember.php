<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterMember extends Model
{

    use HasFactory, HasUuids;
    protected $table = 'letter_members';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
            'letter_id',
            'user_id',
            'position'
    ];

    public function letters()
    {
        return $this->belongsTo(Letter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
