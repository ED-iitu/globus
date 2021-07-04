<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobusInfo extends Model
{
    protected $fillable = [
        'address', 'phone', 'social_url', 'work_time', 'lang'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
