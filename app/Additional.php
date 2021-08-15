<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    protected $fillable = [
        'description', 'lang'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
