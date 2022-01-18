<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodcut extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'availibility'
    ];

    /**
     * Get the Crated_at
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    /**
     * Get the Updated_at
     *
     * @param  string  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function specification()
    {
        return $this->hasOne(Specification::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public static function topProdcuts()
    {
        $prodcuts = Prodcut::with('reviews')->get();
        return $prodcuts->filter(function ($prodcuts) {
            foreach ($prodcuts->reviews as $product) {
                return $product->rate >= 4;
            }
        });
    }
}
