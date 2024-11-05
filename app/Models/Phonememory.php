<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonememory extends Model
{
    use HasFactory;

    protected $table = 'phonememories';

    protected $fillable = [
        'name'
    ];
}
