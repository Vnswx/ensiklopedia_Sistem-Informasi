<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use App\Models\Categories;

class Articles extends Model
{
    protected $fillable = ['user_id', 'categories_id', 'title', 'content', 'image', 'status', 'is_active'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsTo(Categories::class);
    }

}
