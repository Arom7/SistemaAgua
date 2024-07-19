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
        'consumo_total',
        'mes_correspondiente'
    ];

    // Relacion Consumo -- Medidor (Un consumo corresponde a un medidor)
    public function  consumos() {
        return $this->belongsTo(Medidor::class , 'propiedad_id_medidor', 'propiedad_id_consumo');
    }

    public function recibos(){
        return $this-> hasOne(Recibo::class, 'id_consumo_recibo' , 'propiedad_id_consumo');
    }
 }
