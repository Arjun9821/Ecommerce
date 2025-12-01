<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'stock',
        'category_id',
        'image',
        'discount_price',
        'discount_percent',
        'discount_expires_at'
    ];

    // Cast discount_expires_at to Carbon
    protected $casts = [
        'discount_expires_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('quantity');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function reviews() 
    {
        return $this->hasMany(Review::class);
    }

    public function average_rating()
    {
        return $this->reviews()->avg('rating');
    }

    public function getFinalPriceAttribute()
    {
        if ($this->discount_expires_at && now()->lt($this->discount_expires_at)) {
            return $this->discount_price ?? $this->price;
        }
        return $this->price;
    }
}
