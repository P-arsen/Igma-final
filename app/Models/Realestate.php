<?php

namespace App\Models;

use App\Entity\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realestate extends Model
{
    use HasFactory;


    protected $fillable =   [
        'building_type',
        'bathrooms',
        'furniture',
        'renovation',
        'garazh',
        'loghavazan',
        'sauna',
        'bughari',
        'ghorovati_vararan',
        'taghavar',
        'security',
        'odorakich',
        'sarnaran',
        'salojagh',
        'spasq_lvanalu_meqena',
        'washing_machine',
        'choracnogh_meqena',
        'elektrakanutyun',
        'gaz',
        'water',
        'done',
        'active',
        'block',
        'rooms',
        'floor',
        'area',
        'price',
        'name',
        'active',
        'block',
        'special_offer',
        'top',
        'buy_me',
        'urgent',
        'hair_dryer',
        'iron',
        'water_heater',
        'drying_machine',
        'dishwasher',
        'coffee_maker',
        'microwave',
        'stove',
        'fridge',
        'parking_space',
        'internet',
        'air_conditioner',
        'television',
        'window_view',
        'children',
        'pets',
        'balcony',
        'celling_height',
        'bathroom',
        'new_building',
        'currency','region','city','user_id','user_type','category_id','elevator'
    ];


    public function images()
    {
        return $this->hasMany(Realestateimage::class,'item_id','id');
    }

    public function image()
    {
        return $this->hasOne(Realestateimage::class,'item_id','id');
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
