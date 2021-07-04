<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infographic extends Model
{
    protected $fillable = [
        'title', 'description', 'lang'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
