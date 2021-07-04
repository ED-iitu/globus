<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'url'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
