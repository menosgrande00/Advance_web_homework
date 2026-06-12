<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUSES = ['pending', 'processing', 'shipped', 'completed', 'cancelled'];

    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'phone',
        'address',
        'note',
        'total',
        'status',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'total' => 'decimal:2',
            'cancelled_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
