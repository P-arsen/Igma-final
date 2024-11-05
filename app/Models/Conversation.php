<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->hasOne(User::class,'id','send_id');
    }

    public function messages()
    {
        return $this->hasOne(Message::class,'conversation_id','id')->latest();
    }
}
