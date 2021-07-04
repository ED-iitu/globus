<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title', 'lang', 'image', 'link', 'description'
    ];

    protected $hidden = [
        'updated_at', 'lang', 'link'
    ];
}
