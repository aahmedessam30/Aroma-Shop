<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'totalPrice',
        'item_count',
        'is_paid',
        'payment_method',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the is_paid
     *
     * @param  string  $value
     * @return string
     */
    public function getIsPaidAttribute($value)
    {
        return $value == 0 ? 'Not Paid' : 'Paid';
    }
}
