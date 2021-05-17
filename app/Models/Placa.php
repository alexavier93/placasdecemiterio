<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Placa extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'price',
        'height',
        'width',
        'length',
        'weight',
        'image',
    ];

    public function modelos()
    {
        return $this->belongsToMany(Modelo::class);
    }

    public function molduras()
    {
        return $this->belongsToMany(Moldura::class);
    }
    
    public function fundos()
    {
        return $this->belongsToMany(Fundo::class);
    }

    public function fontes()
    {
        return $this->belongsToMany(Fonte::class);
    }
    
}
