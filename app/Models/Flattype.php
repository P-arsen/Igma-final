<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Flattype extends Model
{
    use HasFactory;

    protected $table = 'flattypes';

    protected $fillable =   [
        'name_am','name_ru','name_en'
    ];
}
