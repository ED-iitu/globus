<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title', 'main_image', 'lang', 'images'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
