<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Promocion;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('nombre', 'LIKE', "%$query%")->get();
        $products = Producto::where('nombre', 'LIKE', "%$query%")->get();
        $promotions = Promocion::where('descripcion', 'LIKE', "%$query%")->get();

        // Agregar la propiedad 'tipo' a los resultados
        $users->each(function ($user) {
            $user->tipo = 'usuario';
        });

        $products->each(function ($product) {
            $product->tipo = 'producto';
        });

        $promotions->each(function ($promotion) {
            $promotion->tipo = 'promocion';
        });

        $results = array_merge($users->toArray(), $products->toArray(), $promotions->toArray());

        return response()->json($results);
    }
}
