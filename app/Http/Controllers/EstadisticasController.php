<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
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


    public function estadisticas1(Request $request)
    { // cantidad de productos vendidos en un rango de fecha

        $fecha_inicio = $request->input('fecha_inicio', date('Y-m-d', strtotime('-5 days')));
        $fecha_fin = $request->input('fecha_fin', date('Y-m-d', strtotime('+5 days')));

        $consultaLaravel = DB::table('pedidos')
            ->join('detalles_pedido', 'pedidos.id', '=', 'detalles_pedido.pedido_id')
            ->join('productos', 'detalles_pedido.producto_id', '=', 'productos.id')
            ->join('pagos', 'pedidos.id', '=', 'pagos.pedido_id')
            ->select(
                'productos.id as id',
                'productos.nombre as nombre',
                DB::raw('SUM(detalles_pedido.cantidad) as cantidad'),
                DB::raw('SUM(detalles_pedido.importe) as importe')
            )
            ->where('pedidos.estado', '1')
            ->whereDate('pagos.created_at', '>=', $fecha_inicio)
            ->whereDate('pagos.created_at', '<=', $fecha_fin)
            ->groupBy('productos.id', 'productos.nombre')
            ->get();

        $datosJSON = [
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'consultaLaravel' => $consultaLaravel,
        ];

        return response(json_encode($datosJSON), 200)->header('Content-type', 'text/plain');
    }

    public function estadisticas2(Request $request)
    { // Monto total de ventas diarias en un rango de fechas

        $fecha_inicio = $request->input('fecha_inicio', date('Y-m-d', strtotime('-5 days')));
        $fecha_fin = $request->input('fecha_fin', date('Y-m-d', strtotime('+5 days')));

        $consultaLaravel = DB::table('pedidos')
            ->join('detalles_pedido', 'pedidos.id', '=', 'detalles_pedido.pedido_id')
            ->join('pagos', 'pedidos.id', '=', 'pagos.pedido_id')
            ->select(
                DB::raw('DATE(pagos.created_at) as fecha'),
                DB::raw('SUM(detalles_pedido.importe) as total')
            )
            ->where('pedidos.estado', '1')
            ->whereDate('pagos.created_at', '>=', $fecha_inicio)
            ->whereDate('pagos.created_at', '<=', $fecha_fin)
            ->groupBy(DB::raw('DATE(pagos.created_at)'))
            ->get();

        $datosJSON = [
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'consultaLaravel' => $consultaLaravel,
        ];

        return response(json_encode($datosJSON), 200)->header('Content-type', 'text/plain');
    }

    public function estadisticas3(Request $request)
    { // Productos más vendidos en un periodo especifico.

        $fecha_inicio = $request->input('fecha_inicio', date('Y-m-d', strtotime('-5 days')));
        $fecha_fin = $request->input('fecha_fin', date('Y-m-d', strtotime('+5 days')));
        $limit = $request->input('limit', 3);

        $consultaLaravel = DB::table('pedidos')
            ->join('detalles_pedido', 'pedidos.id', '=', 'detalles_pedido.pedido_id')
            ->join('productos', 'detalles_pedido.producto_id', '=', 'productos.id')
            ->join('pagos', 'pedidos.id', '=', 'pagos.pedido_id')
            ->select(
                'productos.id as id',
                'productos.nombre as nombre',
                DB::raw('SUM(detalles_pedido.cantidad) as total')
            )
            ->where('pedidos.estado', '1')
            ->whereDate('pagos.created_at', '>=', $fecha_inicio)
            ->whereDate('pagos.created_at', '<=', $fecha_fin)
            ->groupBy('productos.id', 'productos.nombre')
            ->limit($limit)
            ->get();

        $datosJSON = [
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'limit' => $limit,
            'consultaLaravel' => $consultaLaravel
        ];

        return response(json_encode($datosJSON), 200)->header('Content-type', 'text/plain');
    }

    public function estadisticas4(Request $request)
    {// Monto vendido diariamente de un producto especifico en un rago de fechas
        $fecha_inicio = $request->input('fecha_inicio', date('Y-m-d', strtotime('-5 days')));
        $fecha_fin = $request->input('fecha_fin', date('Y-m-d', strtotime('+5 days')));
        $producto_id = $request->input('producto_id', 4);

        $consultaLaravel = DB::table('pedidos')
            ->join('detalles_pedido', 'pedidos.id', '=', 'detalles_pedido.pedido_id')
            ->join('productos', 'detalles_pedido.producto_id', '=', 'productos.id')
            ->join('pagos', 'pedidos.id', '=', 'pagos.pedido_id')
            ->select(
                'productos.id as id',
                'productos.nombre as nombre',
                DB::raw('DATE(pagos.created_at) as fecha'),
                DB::raw('SUM(detalles_pedido.cantidad) as cantidad'),
                DB::raw('SUM(detalles_pedido.importe) as monto')
            )
            ->where('pedidos.estado', '1')
            ->whereDate('pagos.created_at', '>=', $fecha_inicio)
            ->whereDate('pagos.created_at', '<=', $fecha_fin)
            ->where('productos.id', $producto_id)
            ->groupBy('productos.id', 'productos.nombre', DB::raw('DATE(pagos.created_at)'))
            ->get();

        $datosJSON = [
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'producto_id' => $producto_id,
            'consultaLaravel' => $consultaLaravel,
        ];

        return response(json_encode($datosJSON), 200)->header('Content-type', 'text/plain');
    }
    
    public function estProd()
    {// Monto vendido diariamente de un producto especifico en un rago de fechas
        $productos = Producto::select('id', 'nombre')->get();
        return response(json_encode($productos), 200)->header('Content-type', 'text/plain');
    }
}
