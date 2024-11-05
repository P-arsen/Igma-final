<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonemodel extends Model
{
    use HasFactory;


    protected $table = 'phonemodels';

    protected $fillable =   [
        'name','brand_id'
    ];
}
