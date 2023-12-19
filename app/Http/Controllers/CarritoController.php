<?php

namespace App\Http\Controllers;

use App\Models\ItemCarrito;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Promocion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarritoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('realizarPedido');
    }

    public function cart(Request $request)
    {
        $carrito = $request->query('cart');
        $datosCarrito = [];

        if ($carrito) {
            $datosCarrito = json_decode(urldecode($carrito), true);
        }

        $subtotal = 0;

        foreach ($datosCarrito as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return view('ecommerce/cart', ['carrito' => $datosCarrito, 'subtotal' => $subtotal]);
    }

    public function realizarPedido(Request $request)
    {
        $carrito = json_decode($request->input('carrito'), true);
        $montoTotal = 0;
        foreach ($carrito as $item) {
            $montoTotal += $item['price'] * $item['quantity'];
        }

        DB::beginTransaction();
        try {
            $pedido = new Pedido();
            $pedido->fecha = Carbon::now();
            $pedido->estado = '0';
            $pedido->usuario_id = Auth::id();
            $pedido->monto_total = $montoTotal;
            $pedido->save();

            foreach ($carrito as $item) {
                $detalle = new PedidoDetalle();
                $detalle->pedido_id = $pedido->id;
                $detalle->producto_id = $item['id'];
                $detalle->precio = $item['price'];
                $detalle->cantidad = $item['quantity'];
                $detalle->descuento = $item['price'] - $item['finalPrice'];
                $detalle->precio_final = $item['finalPrice'];
                $detalle->importe = $item['finalPrice'] * $item['quantity'];
                $detalle->save();
            }

            DB::commit();
            return redirect()->route('cart');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart')->with('error', $e->getMessage());
        }
    }
}
