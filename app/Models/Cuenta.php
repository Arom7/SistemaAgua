<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $primaryKey = 'username';

    protected $table = 'usuario';

    //podemos definir que datos pueden ser alterados
    protected $fillable = [
        'contrasenia',
        'status',
        'username',
    ];

    public function persona()
    {
        return $this->belongsTo(Socio::class, 'id');
    }

    public static function cuentaExistente($username)
    {
        return static::where('username', $username)
                     ->exists();
    }

}
