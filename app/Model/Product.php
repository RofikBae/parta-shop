<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'price'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function Categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
