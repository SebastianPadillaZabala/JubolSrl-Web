<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::all();

        return view('facturas.index', compact('facturas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function indexClient()
    {
        $usuario_id = Auth::id();

        $facturas = Factura::whereHas('pedido', function ($query) use ($usuario_id) {
            $query->where('usuario_id', $usuario_id);
        })->get();

        return view('facturas.index', compact('facturas'))->with('i', (request()->input('page', 1) - 1) * 5);
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

            $factura = new Factura();
            $factura->nit = $request->nit;
            $factura->nombre_cliente = $request->nombre_cliente;
            $factura->monto = $request->monto;
            $factura->fecha = $request->fecha;
            $factura->pedido_id = $request->pedido_id;
            $factura->save();

            return redirect()->route('facturas.index')->with('success', 'Factura creada satisfactoriamente');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $factura = Factura::find($id);
        $productos = PedidoDetalle::where('pedido_id', $factura->pedido_id)->with('producto')->get();
        return view('facturas.show', compact('factura', 'productos'))->with('i', (request()->input('page', 1) - 1) * 5);;
    }

    public function showClient(string $id)
    {
        $factura = Factura::find($id);
        $productos = PedidoDetalle::where('pedido_id', $factura->pedido_id)->with('producto')->get();
        return view('facturas.show', compact('factura', 'productos'))->with('i', (request()->input('page', 1) - 1) * 5);;
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
        Factura::find($id)->delete();
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada satisfactoriamente');
    }

    
    public function view() 
    {
        $usuarioId = Auth::id(); 

        $pedido = Pedido::where('usuario_id', $usuarioId)
            ->latest('id') 
            ->first();

        $factura = Factura::where('pedido_id', $pedido->id)->get();

        $productos = PedidoDetalle::where('pedido_id', $pedido->id)->with('producto')->get();

        return view('ecommerce.invoice', compact('factura', 'productos'));
    }
}
