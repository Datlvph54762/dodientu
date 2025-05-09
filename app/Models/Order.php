<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'payment_method',
        'status',
        'total',
    ];
    
    public function user()
{
    return $this->belongsTo(User::class);
}
public function details()
    {
        return $this->hasMany(OrderItem::class);
    }

public function items()
{
    return $this->hasMany(OrderItem::class);
}

public function payment()
{
    return $this->hasOne(Payment::class);
}

}
