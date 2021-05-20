<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPix extends Model
{
    use HasFactory;

    protected $table = 'payment_pix';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_payment_id',
        'total_paid_amount',
        'qr_code',
        'qr_code_base64',
    ];
    
    public $timestamps = false;

    public function order_payment()
    {
        return $this->belongsTo(OrderPayment::class);
    }

}
