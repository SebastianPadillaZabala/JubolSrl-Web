<?php

namespace App\Http\Controllers;

use App\Models\ItemCarrito;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Promocion;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
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

    public function RecolectarDatos(User $usuario, Pedido $pedido, $nit)
    {
        try {
            $detalle = PedidoDetalle::where('pedido_id', $pedido->id)->get();

            $taPedidoDetalle = [];

            foreach ($detalle as $item) {
                $taPedidoDetalle[] = [
                    "tnCantidad" => $item->cantidad,
                    "tcDescripcion" => "Producto",
                    "tnPrecioUnitario" => $item->precio_final,
                    "tnSubTotal" => $item->precio_final * $item->cantidad
                ];
            }

            $lcComerceID           = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
            $lnMoneda              = 2;
            $lnTelefono            = $usuario->telefono;
            $lcNombreUsuario       = $usuario->nombre;
            $lnCiNit               = $nit;
            $lcNroPago             = "grupo14sa-" . rand(100000, 999999);
            $lnMontoClienteEmpresa = $pedido->monto_total;
            $lcCorreo              = $usuario->email;
            $lcUrlCallBack         = "https://tecno-web14-e5add45ded4b.herokuapp.com/pago_facil/callback/" . $pedido->id;
            $lcUrlReturn           = "https://tecno-web14-e5add45ded4b.herokuapp.com/pago_facil/callback/" . $pedido->id;
            $laPedidoDetalle       = Json_encode($taPedidoDetalle);
            $lcUrl                 = "";

            $loClient = new Client();
            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";

            $laHeader = [
                'Accept' => 'application/json'
            ];

            $laBody   = [
                "tcCommerceID"          => $lcComerceID,
                "tnMoneda"              => $lnMoneda,
                "tnTelefono"            => $lnTelefono,
                'tcNombreUsuario'       => $lcNombreUsuario,
                'tnCiNit'               => $lnCiNit,
                'tcNroPago'             => $lcNroPago,
                "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
                "tcCorreo"              => $lcCorreo,
                'tcUrlCallBack'         => $lcUrlCallBack,
                "tcUrlReturn"           => $lcUrlReturn,
                'taPedidoDetalle'       => $laPedidoDetalle
            ];

            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody
            ]);

            $laResult = json_decode($loResponse->getBody()->getContents());
            $laValues = explode(";", $laResult->values)[1];
            $base64_string = json_decode($laValues)->qrImage;
            $image = base64_decode($base64_string);
            return response($image, 200, ['Content-Type' => 'image/png']);
        } catch (\Throwable $th) {
            return $th->getMessage() . " - " . $th->getLine();
        }
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

            $user = User::find(Auth::id());

            $qr = $this->RecolectarDatos($user, $pedido, '3221443010');

            DB::commit();

            $order = Pedido::find($pedido->id);
            $productos = PedidoDetalle::where('pedido_id', $pedido->id)->with('producto')->get();
    
            return view('ecommerce/pay', ['productos' => $productos, 'pedido' => $order, 'qr' =>$qr]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart')->with('error', $e->getMessage());
        }
    }
}
