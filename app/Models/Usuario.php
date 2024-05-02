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


}
