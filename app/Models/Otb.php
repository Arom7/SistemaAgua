<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otb extends Model
{
    use HasFactory;

    protected $table = 'otbs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_comunidad',
        'direccion',
    ];

    // Relacion Otb -> socios (una OTB tiene muchos socios)
    public function socios() {
        return $this->hasMany( Socio::class , 'socio_id');
    }
}
