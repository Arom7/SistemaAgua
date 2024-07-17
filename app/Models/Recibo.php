<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recibo extends Model
{
    use HasFactory;

    protected $table = 'recibos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'estado_pago',
        'total',
        'fecha_lectura',
        'observaciones'
    ];

    // Relacion recibo -- consumo (Relacion uno a uno)
    public function consumos(){
        return $this->belongsTo(Consumo::class, 'propiedad_id_recibo' , 'propiedad_id_consumo');
    }
}
