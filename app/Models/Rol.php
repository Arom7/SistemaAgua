<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $primaryKey = 'idRol';
    protected $table = 'roles';

    //
    protected $fillable= [
        'nombre_rol',
        'descripcion'
    ];

    // Relacion rol <--> usuario (Un rol puede pertenecer a muchos usuarios / Relacion muchos a muchos)
    public function usuarios() {
        return $this->belongsToMany(Usuario::class , 'usuarios_roles','rol_id', 'usuario_id');
    }
}
