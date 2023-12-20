<?php

namespace App\Http\Middleware;

use App\Models\Pagina;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LogPageViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $pageName = $request->route()->getName();
    
        $pageView = Pagina::where('nombre', $pageName)->first();

        if (!$pageView) {
            $pageView = Pagina::create([
                'nombre' => $pageName,
                'nro_visitas' => 1,
            ]);
        } else {
            $pageView->increment('nro_visitas');
        }
    
        return $next($request);
    }
}
