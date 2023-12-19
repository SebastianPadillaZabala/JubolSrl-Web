<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Producto;
use App\Models\Promocion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarios = User::count();
        $productos = Producto::count();
        $fecha_actual = now();
        $promociones = Promocion::where('fecha_fin', '>=', $fecha_actual)->count();
        $pedidos = Pedido::where('estado', '1')->count();

        $pedidosCliente = Pedido::where('estado', '1')->where('usuario_id', auth()->user()->id)->count();
        $productosCliente = Pedido::join('detalles_pedido', 'pedidos.id', '=', 'detalles_pedido.pedido_id')
            ->where('pedidos.estado', '1')
            ->where('pedidos.usuario_id', auth()->user()->id)
            ->sum('detalles_pedido.cantidad');
        $pagos = Pago::join('pedidos', 'pagos.pedido_id', '=', 'pedidos.id')
            ->where('pedidos.estado', '1')
            ->where('pedidos.usuario_id', auth()->user()->id)
            ->sum('pagos.monto');
        $compraPromocion = Pedido::join('detalles_pedido', 'pedidos.id', '=', 'detalles_pedido.pedido_id')
            ->join('productos', 'detalles_pedido.producto_id', '=', 'productos.id')
            ->join('promociones', 'productos.id', '=', 'promociones.producto_id')
            ->where('pedidos.estado', '1')
            ->where('pedidos.usuario_id', auth()->user()->id)
            ->where('promociones.fecha_inicio', '<=', $fecha_actual)
            ->where('promociones.fecha_fin', '>=', $fecha_actual)
            ->sum('detalles_pedido.cantidad');

        $infoPedidos = Pedido::select(
            'pedidos.fecha',
            'usuarios.nombre as cliente',
            'pedidos.monto_total',
            DB::raw('SUM(detalles_pedido.descuento * detalles_pedido.cantidad) as descuento_total'),
            'pedidos.estado',
            'pagos.metodo_pago'
        )
            ->join('usuarios', 'pedidos.usuario_id', '=', 'usuarios.id')
            ->leftJoin('detalles_pedido', 'pedidos.id', '=', 'detalles_pedido.pedido_id')
            ->leftJoin('pagos', 'pedidos.id', '=', 'pagos.pedido_id')
            ->groupBy('pedidos.id', 'usuarios.nombre', 'pagos.metodo_pago')
            ->get();

        $pedidosUsuario = Pedido::select(
            'pedidos.fecha',
            DB::raw('SUM(detalles_pedido.cantidad) as cantidad_productos'),
            'pedidos.monto_total',
            DB::raw('SUM(detalles_pedido.descuento * detalles_pedido.cantidad) as descuento_total'),
            'pedidos.estado',
            'pagos.metodo_pago'
        )
            ->join('detalles_pedido', 'pedidos.id', '=', 'detalles_pedido.pedido_id')
            ->leftJoin('pagos', 'pedidos.id', '=', 'pagos.pedido_id')
            ->where('pedidos.usuario_id', auth()->user()->id)
            ->groupBy('pedidos.id', 'pagos.metodo_pago')
            ->get();

            return view('dashboard', compact('usuarios', 'productos', 'promociones', 'pedidos', 'pedidosCliente', 'productosCliente', 'pagos', 'compraPromocion', 'pedidosUsuario'));
    }
}
