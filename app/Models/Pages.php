<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Pages extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'image', 'categories_id', 'is_active'];

    public function categories(){
        return $this->belongsTo(Categories::class);
    }


}
