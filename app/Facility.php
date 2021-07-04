<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    const TYPE_SHOP           = 1;
    const TYPE_CINEMA         = 2;
    const TYPE_FOOD           = 3;
    const TYPE_CLOTHING_STORE = 4;
    const TYPE_ENTERTAINMENT  = 5;

    protected $fillable = [
        'name', 'description', 'logo', 'image',
        'category_id', 'web_url', 'social_url',
        'floor', 'work_time', 'map_coords', 'lang', 'is_active', 'order'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
