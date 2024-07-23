<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;

use Illuminate\Http\Request;
// Libreria para realizar la validacion
use Illuminate\Support\Facades\Validator;
// Libreria para encriptar contasenias
use Illuminate\Support\Facades\Hash;

class cuentaController extends Controller
{
    //Funcion de verificacion
    public function login(Request $request){

        $validacion = Validator::make($request->all(),[
            // Reglas de validacion
            'username' => [
                'required',
                'string',
                'regex:/^(?!\s)(?!.*\s$)[a-zA-Z\s]*[a-zA-Z]+[a-zA-Z\s]*$/',
                'max:45',
            ],
            'contrasenia' => [
                'required',
                'string' ,
                'regex:/^[a-zA-Z]+$/',
                'min:8' ,
                'max:255'
            ]
        ]);

        if($validacion->fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'status' => 400,
                'errores' => $validacion -> errors()
            ];
            return response()->json($data,400);
        }

        $username = $request->username;
        //Esto puede ser almacenado en el modelo, considerar este cambio
        $verificar_cuenta = Usuario::cuentaExistente($username);
        //verificamos si la cuenta existe
        if($verificar_cuenta){
            $cuenta = Usuario::find($username);
            //Verificamos si la cadena sin cifrar coincide con su hash cifrado correspondiente almacenado en la base de datos
            if (Hash::check($request->contrasenia,$cuenta->contrasenia)){
                $data = [
                    'message' => 'Ingreso valido.',
                    'status' => 200,
                ];
                return response()->json($data,200);
            }else{
                $data = [
                    'message' => 'Contrasenia incorrecta.',
                    'status' => 400,
                ];
                return response()->json($data,400);
            }
        }else{
            $data = [
                'message' => 'Usuario no encontrado. Registrese por favor.',
                'status' => 404,
            ];
            return response()->json($data,404);
        }
    }
}
