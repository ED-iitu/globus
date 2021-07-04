<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title', 'description', 'lang', 'type'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
