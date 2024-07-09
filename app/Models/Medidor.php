<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidor extends Model
{
    use HasFactory;

    protected $table = 'medidores';
    protected $primaryKey = 'propiedad_id';

    protected $fillable= [
        'id_medidor',
        'propiedad_id',
        'medida_inicial',
        'ultima_medida',
        'propiedades'
    ];

    // Relacion medidores <-- propiedades (Uno a muchos)
    public function propiedades (){
        return $this->belongsTo(Propiedad:: class, 'propiedad_id');
    }

    // Relacion medidores --> consumos (Uno a muchos)
    public function consumos(){
        return $this->hasMany(Consumo::class, 'propiedad_id');
    }

}
