<?php

namespace App\Models;

use App\Entity\Region;
use App\Models\Transportimage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Transportimage;

class Transport extends Model
{
    use HasFactory;

    protected $fillable = [
            'region',
            'city',
            'brand',
            'model',
            'body_type',
            'year',
            'engine_type',
            'engine_size',
            'transmission',
            'drive_type',
            'destination',
            'mils',
            'damaged',
            'gas',
            'steering',
            'cleared',
            'color',
            'wheels',
            'headlights',
            'interior_color',
            'interior_type',
            'sunroof',
            'air_conditioner',
            'heated_seats',
            'heated_steering_wheel',
            'ventilated_seats',
            'cruise_control',
            'tinted_windows',
            'price',
            'currency',
            'description',
            'name',
            'active',
            'block',
            'user_id',
            'user_type',
            'currency',
            'category_id',
];

    public function images()
    {
        return $this->hasMany(Transportimage::class,'item_id','id');
    }

    public function image()
    {
        return $this->hasOne(Transportimage::class,'item_id','id');
    }
    public function region()
    {
        return $this->hasOne(Region::class,'name_en','region');
    }
    public function city()
    {
        return $this->hasOne(Region::class,'id','city_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function type()
    {
        return $this->hasOne(Cartype::class,'id','drive_type');
    }
    public function brand()
    {
        return $this->hasOne(Carbrand::class,'id','brand_id');
    }
    public function model()
    {
        return $this->hasOne(Carmodel::class,'id','model_id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? $this->image->image : 'default-image-url.jpg'; // Provide a default image URL
    }

}
