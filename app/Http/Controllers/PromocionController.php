<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promociones = Promocion::select('promociones.*', 'productos.nombre as producto')
            ->join('productos', 'promociones.producto_id', '=', 'productos.id')
            ->get();

        return view('promociones.index', compact('promociones'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        return view('promociones.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            request()->validate([
                'descripcion' => 'required',
                'descuento' => 'required',
                'fecha_inicio' => 'required',
                'fecha_fin' => 'required',
                'producto' => 'required',
            ]);

            $fecha_actual = Carbon::now()->format('Y-m-d');
            $producto_id = $request->producto;

            $existePromo = Promocion::where('fecha_fin', '>=', $fecha_actual)
                ->where('producto_id', $producto_id)
                ->exists();

            if ($existePromo) {
                return redirect()->route('promociones.index')->with('error', 'No se registro la promocion. Este producto ya tiene una promocion');
            }

            $promocion = new Promocion();
            $promocion->descripcion = $request->descripcion;
            $promocion->descuento = $request->descuento;
            $promocion->fecha_inicio = $request->fecha_inicio;
            $promocion->fecha_fin = $request->fecha_fin;
            $promocion->producto_id = $request->producto;
            $promocion->save();

            return redirect()->route('promociones.index')->with('success', 'Promocion creada satisfactoriamente');
        } catch (\Exception $e) {

            return redirect()->route('promociones.index')->with('error', 'Error al crear el usuario');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $promocion = Promocion::with('producto')->find($id);
        return view('promociones.show', compact('promocion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $promocion = Promocion::find($id);
        $productos = Producto::all();
        return view('promociones.edit', compact('promocion', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            request()->validate([
                'descripcion' => 'required',
                'descuento' => 'required',
                'fecha_inicio' => 'required',
                'fecha_fin' => 'required',
                'producto' => 'required',
            ]);

            $fecha_actual = Carbon::now()->format('Y-m-d');
            $producto_id = $request->producto;

            $existePromo = Promocion::where('id', '!=', $id)
                ->where('fecha_fin', '>=', $fecha_actual)
                ->where('producto_id', $producto_id)
                ->exists();

            if ($existePromo) {
                return redirect()->route('promociones.index')->with('error', 'No se actualizo la promocion. Este producto ya tiene una promocion');
            }

            $promocion = Promocion::find($id);
            $promocion->descripcion = $request->descripcion;
            $promocion->descuento = $request->descuento;
            $promocion->fecha_inicio = $request->fecha_inicio;
            $promocion->fecha_fin = $request->fecha_fin;
            $promocion->producto_id = $request->producto;
            $promocion->save();
            return redirect()->route('promociones.index')->with('success', 'Promocion actualizada satisfactoriamente');
        } catch (\Exception $e) {
            return redirect()->route('promociones.index')->with('error', 'Error al actualizar la promocion');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Promocion::find($id)->delete();
        return redirect()->route('promociones.index')->with('success', 'Promocion eliminada satisfactoriamente');
    }
}
