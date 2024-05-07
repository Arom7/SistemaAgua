<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cuenta;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\Persona;
use Illuminate\Support\Facades\Validator;

class usuarioController extends Controller
{
    public function index(){
         $usuarios = Usuario::all();
         if($usuarios->isEmpty()){
            $data = [
                'message' => 'No se encontraron usuarios',
                'status' => 400,
            ];
         }else{
            $data = [
                'message' => 'Usuarios encontrados',
                'status' => 200,
                'usuarios' => $usuarios
            ];
         }
         return response()->json($data,200);
    }

    public function store (Request $request)
    {
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
            return response()->json($data,200);
        }
        try {

            $esta_registrado = Usuario::usuarioExistente($request->nombre,$request->primerApellido,$request->segundoApellido);

            if(!$esta_registrado){
                $usuario = Usuario::create([
                    'nombre' => $request->nombre,
                    'primerApellido' => $request->primerApellido,
                    'segundoApellido' => $request->segundoApellido
                ]);
            }

            $id_usuario = Usuario::buscar_id_usuario($request->nombre,$request->primerApellido,$request->segundoApellido);

            $esta_registrada_cuenta = Cuenta::cuentaExistente($request->username);

            if(!$esta_registrada_cuenta){

                $contrasenia_encriptada = Hash::make($request->contrasenia);

                $cuenta = Cuenta::create([
                    'username' => $request->username,
                    'contrasenia' => $contrasenia_encriptada,
                    'status' => true,
                    'Persona_idpersona' => $id_usuario->idpersona
                ]);

                $data = [
                    'message' => 'Cuenta creada exitosamente. Solo cuenta.',
                    'status' => 200,
                    'usuario' => $cuenta
                ];
                return response()->json($data, 200);
            }else{
                $data = [
                    'message' => 'Usuario y cuenta ya registrados.',
                    'status' => 400
                ];
                return response()->json($data, 200);
            }

        } catch (\Exception $e) {
            $data = [
                'message' => 'Error al crear el usuario: ' . $e->getMessage(),
                'status' => 500,
            ];
            return response()->json($data, 500);
        }
    }

    public function show($id){
        $usuario = Usuario::find($id);

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
        $usuario = Usuario::find($id);

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

        $usuario = Usuario::find($id);

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

        $usuario = Usuario::find($id);

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
