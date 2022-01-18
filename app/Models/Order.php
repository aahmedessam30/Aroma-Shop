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
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_country',
        'billing_city',
        'billing_address',
        'billing_zip',
        'shipped',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prodcuts()
    {
        return $this->belongsToMany(Prodcut::class, 'prodcut_orders')->withPivot(['quantity', 'total']);
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
