<?php

//Los modelos son como volver a realizar una base de datos, aca tenemos que establecer relaciones en como esta armado la base de datos, debe estar igual
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $primaryKey = 'idpersona';

    protected $table = 'persona';

    //podemos definir que datos pueden ser alterados
    protected $fillable = [
        'nombre',
        'primerApellido',
        'segundoApellido'
    ];

    public static function usuarioExistente($nombre, $primerApellido, $segundoApellido)
    {
        return static::where('nombre', $nombre)
                     ->where('primerApellido', $primerApellido)
                     ->where('segundoApellido', $segundoApellido)
                     ->exists();
    }

    public static function buscar_id_usuario($nombre, $primerApellido, $segundoApellido){
        $usuario = static::where('nombre', $nombre)
                     ->where('primerApellido', $primerApellido)
                     ->where('segundoApellido', $segundoApellido)
                     ->select('idpersona')
                     ->first();
        return $usuario;
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idpersona');
    }

}
