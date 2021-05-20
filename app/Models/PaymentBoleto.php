<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentBoleto extends Model
{
    use HasFactory;

    protected $table = 'payment_boleto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_payment_id',
        'payment_method_reference_id',
        'verification_code',
        'total_paid_amount',
        'external_resource_url'
    ];

    public $timestamps = false;

    public function order_payment()
    {
        return $this->belongsTo(OrderPayment::class);
    }

}
