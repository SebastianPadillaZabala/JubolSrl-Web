<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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




    public function productEcommerce()
    {
        $fechaActual = Carbon::now()->format('Y-m-d');

        $allProducts = DB::select("
        SELECT
            p.id AS id,
            p.nombre AS nombre,
            p.descripcion AS descripcion,
            p.imagen AS imagen,
            p.stock AS stock,
            p.precio AS precio,
            CASE
                WHEN pr.producto_id IS NOT NULL THEN pr.descuento
                ELSE 0
            END AS descuento,
            CASE
                WHEN pr.producto_id IS NOT NULL THEN ROUND(p.precio * (pr.descuento / 100), 2)
                ELSE 0
            END AS monto_dcto,
            CASE
                WHEN pr.producto_id IS NOT NULL THEN ROUND(p.precio * (1 - pr.descuento / 100), 2)
                ELSE ROUND(p.precio, 2)
            END AS precio_final
        FROM productos p
        LEFT JOIN (
            SELECT producto_id, MAX(descuento) AS descuento
            FROM promociones
            WHERE fecha_inicio <= ? AND fecha_fin >= ?
            GROUP BY producto_id
        ) pr ON p.id = pr.producto_id
        LIMIT 4
    ", [$fechaActual, $fechaActual]);


        $productsDeal = DB::select("
            SELECT
                p.id AS id,
                p.nombre AS nombre,
                p.descripcion AS descripcion,
                p.imagen AS imagen,
                p.stock AS stock,
                p.precio AS precio,
                ROUND(p.precio * (pr.descuento / 100), 2) AS monto_dcto,
                ROUND(p.precio * (1 - pr.descuento / 100), 2) AS precio_final
            FROM productos p
            LEFT JOIN (
                SELECT producto_id, MAX(descuento) AS descuento
                FROM promociones
                WHERE fecha_inicio <= ? AND fecha_fin >= ?
                GROUP BY producto_id
            ) pr ON p.id = pr.producto_id
            WHERE pr.producto_id IS NOT NULL
        ", [$fechaActual, $fechaActual]);

        // return dd($resultados);
        return view('ecommerce/home', ['allProducts' => $allProducts, 'productsDeal' => $productsDeal]);
    }


    public function allProductsEcommerce()
    {
        $fechaActual = Carbon::now()->format('Y-m-d');

        $allProducts = DB::select("
            SELECT
                p.id AS id,
                p.nombre AS nombre,
                p.descripcion AS descripcion,
                p.imagen AS imagen,
                p.stock AS stock,
                p.precio AS precio,
                CASE
                    WHEN pr.producto_id IS NOT NULL THEN pr.descuento
                    ELSE 0
                END AS descuento,
                CASE
                    WHEN pr.producto_id IS NOT NULL THEN ROUND(p.precio * (pr.descuento / 100), 2)
                    ELSE 0
                END AS monto_dcto,
                CASE
                    WHEN pr.producto_id IS NOT NULL THEN ROUND(p.precio * (1 - pr.descuento / 100), 2)
                    ELSE ROUND(p.precio, 2)
                END AS precio_final
            FROM productos p
            LEFT JOIN (
                SELECT producto_id, MAX(descuento) AS descuento
                FROM promociones
                WHERE fecha_inicio <= ? AND fecha_fin >= ?
                GROUP BY producto_id
            ) pr ON p.id = pr.producto_id
        ", [$fechaActual, $fechaActual]);

        return view('ecommerce/all-products', ['allProducts' => $allProducts]);
    }
}
