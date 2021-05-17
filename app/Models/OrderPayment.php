<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'payment_id',
        'payment_type',
        'payment_method',
    ];

    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function payment_creditcard()
    {
        return $this->hasOne(PaymentCreditcard::class);
    }

    public function payment_boleto()
    {
        return $this->hasOne(PaymentBoleto::class);
    }

    public function payment_pix()
    {
        return $this->hasOne(PaymentPix::class);
    }

}
