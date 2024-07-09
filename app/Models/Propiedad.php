<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedades';
    protected $primaryKey = 'id';

    protected $fillable = [
        'socio_id',
        'cuadra_propiedad',
        'total_multas_propiedad',
        'descripcion_propiedad'
    ];

    // Relacion propiedad -- socio (Una propiedad pertenece a un socio)
    public function socio(){
        return $this->belongsTo(Socio::class);
    }

    // Relacion propiedad <-> multas (Una propiedad puede tener muchas multas / Relacion muchos a muchos)
    public function infracciones(){
        return $this->belongsToMany(Infraccion::class , 'propiedades_multas' , 'propiedad_id' , 'infraccion_id');
    }

    // Relacion propiedad -> medidores (Una propiedad puede tener muchos medidores)
    public function medidores() {
        return $this->hasMany(Medidor::class , 'propiedad_id');
    }
}
