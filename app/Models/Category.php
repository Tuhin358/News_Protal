<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id','id');
    }


}
