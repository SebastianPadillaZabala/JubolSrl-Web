<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            request()->validate([
                'nombre' => 'required',
                'precio' => 'required',
                'descripcion' => 'required',
                'imagen' => 'required',
                'stock' => 'required',
            ]);
            $input = $request->all();
            if ($files = $request->File('imagen')) {
                $destination = public_path('/assets/img/productos');
                $logoImage = date('YmdHis') . '.' . $files->getClientOriginalExtension();
                $files->move($destination, $logoImage);
                $input['imagen'] = "$logoImage";

                $imageModel = new Producto();
                $imageModel->nombre = $request->nombre;
                $imageModel->precio = $request->precio;
                $imageModel->descripcion = $request->descripcion;
                $imageModel->imagen = "$logoImage";
                $imageModel->stock = $request->stock;
                $imageModel->save();
            }
            return redirect()->route('productos.index')->with('success', 'Producto creado satisfactoriamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Error al crear el producto');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::find($id);
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::find($id);
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productos)
    {
        try {
            $productos = Producto::find($productos);
            $vacio = '';
            if ($files = $request->file('imagen')) {
                $destination = public_path('/assets/img/productos');
                $logoImage = date('YmdHis') . '.' . $files->getClientOriginalExtension();
                $files->move($destination, $logoImage);
                $vacio = $logoImage;
            }
            $productos->nombre = $request->nombre;
            $productos->descripcion = $request->descripcion;
            $productos->precio = $request->precio;
            $productos->stock = $request->stock;
            if ($vacio != '') {
                $productos->imagen = $vacio;
            }
            $productos->save();
            return redirect()->route('productos.index')->with('success', 'Producto actualizado satisfactoriamente');

        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Error al actualizar el producto');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Producto::find($id)->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado satisfactoriamente');
    }
}
