<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;

    protected $table = 'telefonos';
    protected $primaryKey = 'id_telefono';

    protected $fillable =[
        'id_telefono',
        'numero_telefonico',
        'socio_id'
    ];

    //Relacion Telefono -- Socio (Un telefono pertenece a un socio).
    public function socio(){
        return $this-> belongsTo(Socio::class, 'socio_id', 'id');
    }
}
