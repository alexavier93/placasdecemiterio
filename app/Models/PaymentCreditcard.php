<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCreditcard extends Model
{
    use HasFactory;

    protected $table = 'payment_creditcard';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_payment_id',
        'installments',
        'installment_amount',
        'total_paid_amount'
    ];

    public $timestamps = false;

    public function order_payment()
    {
        return $this->belongsTo(OrderPayment::class);
    }
}
