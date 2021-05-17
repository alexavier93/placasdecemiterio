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
        'customer_id',
        'address_id',
        'code',
        'total',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order_product()
    {
        return $this->belongsTo(OrderProduct::class);
    }

    public function order_shipment()
    {
        return $this->hasOne(OrderShipment::class);
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function order_payment()
    {
        return $this->hasOne(OrderPayment::class);
    }

}
