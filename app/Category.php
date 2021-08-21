<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'image', 'lang'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function facility()
    {
        return $this->hasMany(Facility::class);
    }
}
