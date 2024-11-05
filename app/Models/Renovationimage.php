<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renovationimage extends Model
{
    use HasFactory;

    protected $fillable =   [
        'item_id','image'
    ];
}
