<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infraccion extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'reglas_infraccion';

    protected $fillable = [
        'criterio_infraccion',
        'descripcion_infraccion',
        'monto_infraccion'
    ];

    //Relacion reglas_infraccion <--> propiedades (muchos a muchos)
    public function propiedades(){
        return $this->belongsToMany(Propiedad::class , 'multas');
    }
}
