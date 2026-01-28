<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterMembers extends Model
{

    use HasFactory, HasUuids;
    protected $table = 'letter_members';
    protected $fillable = [
            'letter_id',
            'nim',
    ];

    public function letters()
    {
        return $this->belongsTo(Letters::class);
    }

}
