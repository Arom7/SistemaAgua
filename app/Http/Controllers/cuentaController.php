<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
// Libreria para realizar la validacion
use Illuminate\Support\Facades\Validator;
// Libreria para encriptar contasenias
use Illuminate\Support\Facades\Hash;

class cuentaController extends Controller
{
    //Funcion de de ingreso
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
                'min:8' ,
                'max:255'
            ]
        ], [
            'username.regex' => 'El nombre de usuario es incorrecto, no se debe empezar con espacios vacios, ni terminar',
            'contrasenia.min' => 'Todas las contrasenias registradas tienen por lo menos 8 caracteres.'
        ]);

        if($validacion->fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'errores' => $validacion -> errors()
            ];

            return view('index',['datos' => $data]);

        } else{
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
                    
                    return view('dashboard', ['datos'=>$data]);
                }else{
                    $data = [
                        'message' => 'Contrasenia incorrecta.',
                        'status' => 400,
                    ];
                    return view('index', ['datos'=>$data]);
                }
            }else{
                $data = [
                    'message' => 'Usuario no encontrado. Registrese por favor.',
                    'status' => 404,
                ];
                return view('index', ['datos'=>$data]);
            }
        }


    }
}
