<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonebrand extends Model
{
    use HasFactory;

    protected $table = 'phonebrands';

    protected $fillable = [
        'name'
    ];
}
