<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = [
        'floor', 'image'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
