<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'placa_id',
        'modelo_id',
        'moldura_id',
        'fundo_id',
        'fonte_id',
        'name',
        'birthdate',
        'deathdate',
        'phrase',
        'observation',
        'image',
        'image_crop',
        'price',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
    
}