<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    /**
     * The user who wrote the review
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The product this review belongs to
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Optional helper: return stars as array for Blade
     */
    public function stars()
    {
        return range(1, 5);
    }
}
