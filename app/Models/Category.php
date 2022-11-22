<?php

namespace App\Models;

use App\Models\BaseModel;

class Category extends BaseModel
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
    ];
}
