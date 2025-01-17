<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller

{
     // Función de inicio de sesión
    public function login(Request $request)
    {
        // Buscamos al usuario por su correo
        $usuario = Usuarios::where('email', $request->email)->first();

        if ($usuario == null) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        // Verificamos si la contraseña coincide con la almacenada 
        if (Hash::check($request->password, $usuario->password)) {

            $data = [
                'message' => 'Usuario logueado correctamente',
                'status' => 200,
                'data' => $usuario
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Contraseña incorrecta',
                'status' => 401
            ];
            return response()->json($data, 401);
        }
    }
 // Función para obtener todos los usuarios
    public function index()
    {
        $usuarios = Usuarios::all();

        if ($usuarios->isEmpty()) {
            $data = [
                'message' => 'No hay usuarios registrados',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Usuarios recuperados correctamente',
            'status' => 200,
            'data' => $usuarios
        ];

        return response()->json($data, 200);
    }
     // Función para crear un nuevo usuario
    public function store(Request $request)
    {
        // Comprobamos si ya existe un usuario con el mismo correo
        $usuario = Usuarios::where('email', $request->email)->first();
        // Si existe usuario respondemos con un error
        if ($usuario != null) {
            $data = [
                'message' => 'Ya existe un usuario con ese email',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
          // Si no existe creamos un nuevo usuario
        $usuario = new Usuarios();
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        $data = [
            'message' => 'Usuario creado correctamente',
            'status' => 201
        ];

        return response()->json($data, 201);
    }
     // Función para obtener un usuario a partir de un id
    public function show($id)
    {
        $usuario = Usuarios::find($id);

        if ($usuario == null) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Usuario recuperado correctamente',
            'status' => 200,
            'data' => $usuario
        ];

        return response()->json($data, 200);
    }

}
