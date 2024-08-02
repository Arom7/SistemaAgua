<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Socio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class socioController extends Controller
{
    public function index(){
        try{
            $socios = Socio::all();
            if($socios->isEmpty()){
                $data = [
                    'message' => 'No se encontraron socios registrados',
                    'status' => 400,
                ];
            }else{
                $data = [
                    'message' => 'Socios encontrados',
                    'status' => 200,
                    'usuarios' => $socios
                ];
            }
            //Retornamos la vista con la lista de socios
            //return view();
        }catch (\Exception $e){
            $data = [
                'message' => 'Error al obtener los usuarios: '.$e->getMessage(),
                'status' => 500
            ];
            //Retornamos la vista con error
            //return view();
        }
    }

    public function store (Request $request)
    {
        try {
            $validacion = Validator::make($request->all(),[
                // Validaciones a datos a socios
                'nombre' => ['required', 'string', 'regex:/^(?!\s)(?!.*\s$)[a-zA-Z\s]*[a-zA-Z]+[a-zA-Z\s]*$/', 'max:85'],
                'primer_apellido' => ['required', 'string', 'regex:/^[a-zA-Z]+$/', 'max:85'],
                'segundo_apellido' => ['nullable', 'string', 'regex:/^[a-zA-Z]+$/', 'max:85'],
                'ci' => ['required', 'string', 'regex:/^[a-zA-Z0-9]+$/', 'max:40'],
                // Validaciones a datos de usuario
                'username' => ['required', 'string' , 'regex:/^[a-zA-Z0-9]+$/', 'min: 6', 'max:15'],
                'email' => ['required', 'email', 'unique:usuarios,email'],
                'contrasenia' => ['required', 'string' , 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$']
            ], [
                'nombre.regex' => 'Tu nombre solo puede contener letras y espacios.',
                'primer_apellido.regex' => 'Tu primer apellido solo puede contener letras.',
                'segundo_apellido.regex' => 'Tu segundo apellido solo puede contener letras',
                'ci.regex' => 'El CI solo puede contener letras y números.',
                'username.regex' => 'Su username debe contener solo letras mayusculas o minusculas ademas de numeros.',
                'email.email' => 'El campo debe ser una direccion electronica valida',
                'email.unique' => 'El correo ya se encuentra registrado.',
                'contrasenia.regex' => 'La contrasenia debe contener al menos una mayuscula, una minuscula, un numero, un caracter especial y una longitud minima de 8 caracteres'
            ]);

            if ($validacion -> fails()){
                $data = [
                    'message' => 'Error, al validar datos',
                    'status' => 400,
                    'errores' => $validacion -> errors()
                ];
                return view('index' , ['datos' => $data]);
            }else{
                $esta_registrado = Socio::usuarioExistente($request->nombre,$request->primer_apellido,$request->segundo_apellido);

                if(!$esta_registrado){
                    $socio = Socio::create([
                        'nombre_socio' => $request->nombre,
                        'primer_apellido_socio' => $request->primer_apellido,
                        'segundo_apellido_socio' => $request->segundo_apellido,
                        'ci_socio' => $request->ci,
                        'otb_id' => 1
                    ]);
                }

                $esta_registrada_cuenta = Usuario::cuentaExistente($request->username);

                if(!$esta_registrada_cuenta){

                    $id_usuario = Socio::buscar_id_usuario($request->nombre,$request->primer_apellido,$request->segundo_apellido);
                    $contrasenia_encriptada = Hash::make($request->contrasenia);

                    $cuenta = Usuario::create([
                        'username' => $request->username,
                        'contrasenia' => $contrasenia_encriptada,
                        'email' => $request->email,
                    ]);

                    $cuenta->socio_id_usuario = $id_usuario;
                    $cuenta->save();

                    $data = [
                        'message' => 'Cuenta creada exitosamente.',
                        'status' => 201,
                        'usuario' => $cuenta
                    ];
                    return view('index', ['datos' => $data]);
                }else{
                    $data = [
                        'message' => 'Usuario y cuenta ya registrados.',
                        'status' => 200
                    ];
                    return view('index', ['datos' => $data]);
                }
            }



        } catch(\Illuminate\Database\QueryException $e){
            return view('index', ['datos' =>[
                'message' => 'Error en la consulta de la base de datos: ' . $e->getMessage(),
                'status' => 500,
            ]]) ;
        }catch (\Exception $e) {
            return view('index', ['datos' => [
                'message' => 'Error al crear el usuario: ' . $e->getMessage(),
                'status' => 500,
            ]]);
        }
    }

    public function show($id){
        $usuario = Socio::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $data = [
            'usuario' => $usuario,
            'status' => 200
        ];

        return response()->json($data,200);
    }

    public function destroy($id){
        $usuario = Socio::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $usuario -> delete();

        $data = [
            'message' => 'Usuario eliminado',
            'status' => 200
        ];

        return response()->json($data,200);
    }

    public function update (Request $request,$id){

        $usuario = Socio::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validacion = Validator::make($request->all(),[
            'nombre' => 'required', 'string', 'regex:/^(?!\s)(?!.*\s$)[a-zA-Z\s]*[a-zA-Z]+[a-zA-Z\s]*$/','max:45',
            'primerApellido' => 'required', 'string' , 'regex:/^[a-zA-Z]+$/' ,'max:45',
            'segundoApellido' => 'nullable','string', 'regex:/^[a-zA-Z]+$/','max:45'
        ]);

        if ($validacion -> fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'status' => 400,
                'errores' => $validacion -> errors()
            ];
            return response()->json($data,400);
        }

        $usuario->nombre = $request->nombre;
        $usuario->primerApellido = $request->primerApellido;
        $usuario->segundoApellido = $request->segundoApellido;

        $usuario->save();

        $data = [
            'message' => 'Datos actualizados',
            'usuario' => $usuario,
            'status' => 200
        ];

        return response()->json($data,200);

    }

    public function update_parcial(Request $request, $id){

        $usuario = Socio::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validacion = Validator::make($request->all(),[
            'nombre' =>'string', 'regex:/^(?!\s)(?!.*\s$)[a-zA-Z\s]*[a-zA-Z]+[a-zA-Z\s]*$/','max:45',
            'primerApellido' =>'string' , 'regex:/^[a-zA-Z]+$/' ,'max:45',
            'segundoApellido' => 'nullable','string', 'regex:/^[a-zA-Z]+$/','max:45'
        ]);

        if ($validacion -> fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'status' => 400,
                'errores' => $validacion -> errors()
            ];
            return response()->json($data,400);
        }

        if($request->has('nombre')){
            $usuario->nombre = $request->nombre;
        }
        if($request->has('primerApellido')){
            $usuario->primerApellido = $request->primerApellido;
        }
        if($request->has('segundoApellido')){
            $usuario->segundoApellido = $request->segundoApellido;
        }

        $usuario->save();

        $data = [
            'message' => 'Estudiante actualizado',
            'usuario' => $usuario,
            'status' => 200
        ];

        return response()->json($data,200);

    }

}
