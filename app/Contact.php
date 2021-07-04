<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'phone', 'address', 'social_links', 'work_time', 'lang'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
