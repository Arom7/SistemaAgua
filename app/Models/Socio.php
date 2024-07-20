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

    // Relacion socio -> usuarios (un socio tiene muchos usuarios)
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'socio_id_usuario','id');
    }

    // Relacion socio->propiedad (un socio tiene muchas propiedades)
    public function propiedades(){
        return $this->hasMany(Propiedad::class,'socio_id','id');
    }

    // Relacion socio->telefono (un socio puede tener muchos telefonos)
    public function telefonos() {
        return $this->hasMany(Telefono::class, 'socio_id_telefono','id');
    }

    // Relacion socio -- otb (un socio pertenece a una otb)
    public function otb() {
        return $this->belongsTo(Otb::class,'otb_id','id');
    }

    public static function usuarioExistente($nombre, $primerApellido, $segundoApellido)
    {
        return static::where('nombre_socio', $nombre)
                     ->where('primer_apellido_socio', $primerApellido)
                     ->where('segundo_apellido_socio', $segundoApellido)
                     ->exists();
    }

    public static function buscar_id_usuario($nombre, $primerApellido, $segundoApellido){
        return static::where('nombre_socio', $nombre)
                     ->where('primer_apellido_socio', $primerApellido)
                     ->where('segundo_apellido_socio', $segundoApellido)
                     ->select('id')
                     ->first();
    }
}
