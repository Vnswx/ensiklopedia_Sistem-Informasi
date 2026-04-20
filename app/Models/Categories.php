<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Articles;
use App\Models\Pages;

class Categories extends Model
{
    protected $fillable = ['title', 'code'];

    public function article(){
        return $this->hasMany(Articles::class);
    }

    public function pages(){
        return $this->hasMany(Pages::class);
    }
}
