<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterType extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'letter_type';
    protected $fillable = [
        'abbr', 'expan', 'status',
    ];
}
