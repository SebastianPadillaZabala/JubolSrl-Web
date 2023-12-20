<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function incrementCount($pageName)
    {
        $pageView = Pagina::where('nombre', $pageName)->first();

        if (!$pageView) {
            $pageView = Pagina::create([
                'nombre' => $pageName,
                'nro_visitas' => 1,
            ]);
        } else {
            $pageView->increment('nro_visitas');
        }

        return redirect()->back();
    }

    public function getPageViews()
    {
        $pageViews = Pagina::all();

        return view('paginas', compact('pageViews'));
    }
}
