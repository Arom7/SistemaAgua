<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Socio;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
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

                    $usuario = Usuario::create([
                        'username' => $request->username,
                        'contrasenia' => Hash::make($request->contrasenia),
                        'email' => $request->email,
                    ]);

                    $usuario->socio_id_usuario = $id_usuario;
                    $usuario->save();

                    event(new Registered($usuario));

                    Auth::login($usuario);

                    return redirect(RouteServiceProvider::HOME);
                }else{
                    $data = [
                        'message' => 'Usuario y cuenta ya registrados.',
                        'status' => 200
                    ];
                    return view('index', ['datos' => $data]);
                }
            }
        }catch(\Illuminate\Database\QueryException $e){
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
}
