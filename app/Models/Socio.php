<?php

//Los modelos son como volver a realizar una base de datos, aca tenemos que establecer relaciones en como esta armado la base de datos, debe estar igual
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'socios';

    //podemos definir que datos pueden ser alterados
    protected $fillable = [
        'nombre_socio',
        'primer_apellido_socio',
        'segundo_apellido_socio',
        'ci_socio',
    ];

    public static function usuarioExistente($nombre, $primerApellido, $segundoApellido)
    {
        return static::where('nombre_socio', $nombre)
                     ->where('primer_apellido_socio', $primerApellido)
                     ->where('segundo_apellido_socio', $segundoApellido)
                     ->exists();
    }

    public static function buscar_id_usuario($nombre, $primerApellido, $segundoApellido){
        $socio = static::where('nombre_socio', $nombre)
                     ->where('primer_apellido_socio', $primerApellido)
                     ->where('segundo_apellido_socio', $segundoApellido)
                     ->select('id')
                     ->first();
        return $socio;
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'socio_id');
    }

}
