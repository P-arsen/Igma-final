<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportimage extends Model
{
    use HasFactory;

    protected $fillable =   [
        'item_id','image'
    ];
    public function transport()
    {
        return $this->belongsTo(Transport::class, 'item_id');
    }


}
