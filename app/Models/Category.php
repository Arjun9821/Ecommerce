<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name']; // Only include columns that exist in DB

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
