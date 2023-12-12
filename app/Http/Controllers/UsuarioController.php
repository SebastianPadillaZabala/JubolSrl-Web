<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
