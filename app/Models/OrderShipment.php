<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'tipo',
        'prazo',
        'valor',
        'tracking_number'
    ];
    
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}


	
	
		