<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rol;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::select('usuarios.*', 'roles.nombre as rol')
            ->join('roles', 'usuarios.rol_id', '=', 'roles.id')
            ->get();

        return view('usuarios.index', compact('usuarios'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            request()->validate([
                'nombre' => 'required',
                'email' => 'required',
                'password' => 'required',
                'direccion' => 'required',
                'telefono' => 'required',
                'rol' => 'required',
            ]);

            $user = new User();
            $user->nombre = $request->nombre;
            $user->email = $request->email;
            $user->password = bcrypt($request->input('password'));
            $user->direccion = $request->direccion;
            $user->telefono = $request->telefono;
            $user->rol_id = $request->rol;
            $user->save();

            return redirect()->route('usuarios.index')->with('success', 'Usuario creado satisfactoriamente');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')->with('error', 'Error al crear el usuario');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::with('rol')->find($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuarios = User::with('rol')->find($id);
        $roles = Rol::all();
        return view('usuarios.edit', compact('usuarios', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $usuario = User::find($id);
            $usuario->nombre = $request->nombre;
            $usuario->email = $request->email;
            $usuario->direccion = $request->direccion;
            $usuario->telefono = $request->telefono;
            $usuario->rol_id = $request->rol;;
            $usuario->save();
            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado satisfactoriamente');

        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')->with('error', 'Error al actualizar el usuario');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado satisfactoriamente');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $credentials = array(
            'email' => $email,
            'password' => $password
        );
        $auth = Auth::attempt($credentials);

        if ($auth) {
            $user = Auth::user();

            switch ($user->rol_id) {
                case 1:
                    return redirect()->route('dashboard');
                    break;
                case 2:
                    return redirect()->route('dashboard');
                    break;
                case 3:
                    return redirect()->route('dashboard');
                    break;
                default:
                    break;
            }
        } else {
            return back()->withErrors([
                'message' => 'El correo o la contraseña son incorrectos'
            ]);
        }
    }

    public function register_Client(Request $request)
    {
        $cliente = new User();
        $cliente->nombre = $request->input('nombre');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->rol_id = 3;
        $cliente->email = $request->input('email');
        $cliente->password = bcrypt($request->input('password'));
        $cliente->save();

        $email = $request->input('email');
        $password = $request->input('password');
        $credentials = array(
            'email' => $email,
            'password' => $password
        );
        $auth = Auth::attempt($credentials);

        return redirect()->route('dashboard');
    }
}
