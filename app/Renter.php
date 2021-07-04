<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $fillable = [
        'title', 'description', 'lang', 'phone'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
