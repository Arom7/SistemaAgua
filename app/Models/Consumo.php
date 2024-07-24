<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    use HasFactory;

    protected $table = 'consumos';
    protected $primaryKey = 'propiedad_id_consumo';

    protected $fillable = [
        'lectura_actual',
        'mes_correspondiente'
    ];

    protected $guarded = [
        'consumo_total'
    ];

    // Relacion Consumo -- Medidor (Un consumo corresponde a un medidor)
    public function  medidor() {
        return $this->belongsTo(Medidor::class , 'propiedad_id_consumo', 'propiedad_id_medidor');
    }

    public function recibos(){
        return $this-> hasOne(Recibo::class, 'id_consumo_recibo' , 'propiedad_id_consumo');
    }
 }
