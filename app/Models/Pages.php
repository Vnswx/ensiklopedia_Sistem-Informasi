<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'image', 'is_active'];

}
