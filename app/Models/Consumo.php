<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    use HasFactory;

    protected $table = 'consumos';
    protected $primaryKey = 'propiedad_id';

    protected $fillable = [
        'propiedad_id',
        'consumo_total',
        'mes_correspondiente'
    ];

    // Relacion Consumo -- Medidor (Un consumo corresponde a un medidor)
    public function  consumos() {
        return $this->belongsTo(Medidor::class , 'propiedad_id');
    }

    public function recibos(){
        return $this-> hasOne(Recibo::class, 'propiedad_id' , 'propiedad_id');
    }
 }
