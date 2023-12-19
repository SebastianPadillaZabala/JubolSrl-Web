<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Pago;
use App\Models\Pedido;
use App\Models\User;
use App\Models\PedidoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pago::all();

        return view('pagos.index', compact('pagos'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function indexClient()
    {
        $usuario_id = Auth::id();

        $pagos = Pago::whereHas('pedido', function ($query) use ($usuario_id) {
            $query->where('usuario_id', $usuario_id);
        })->get();

        return view('pagos.index', compact('pagos'))->with('i', (request()->input('page', 1) - 1) * 5);
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
    public function store(Request $request, $id)
    {
        $pedido = Pedido::find($id);

        $pago = new Pago();
        $pago->monto = $pedido->monto_total;
        $pago->fecha = $pedido->fecha;
        $pago->metodo_pago = "QR";
        $pago->pedido_id = $id;
        $pago->save();

        $pedido->estado = 1;
        $pedido->save();

        $factura = new Factura();
        $factura->nit = $request->nit;
        $factura->nombre_cliente = $request->nombre;
        $factura->monto = $pedido->monto_total;
        $factura->fecha = $pedido->fecha;
        $factura->pedido_id = $id;
        $factura->save();

        return redirect()->route('factura-view')->with('success', 'Pago realizado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pago = Pago::find($id);
        return view('pagos.show', compact('pago'));
    }

    public function showClient(string $id)
    {
        $pago = Pago::find($id);
        return view('pagos.show', compact('pago'));
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
        Pago::find($id)->delete();
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado satisfactoriamente');
    }

}
