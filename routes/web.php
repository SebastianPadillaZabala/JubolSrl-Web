<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagoFacilController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Producto;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::post('/IniciarSesion',[UsuarioController::class, 'login'])
->name('IniciarSesion');

Route::post('/RegistrarCliente',[UsuarioController::class, 'register_Client'])
->name('RegistarCliente');


Route::group(['prefix' => 'pago_facil'], function () {
    Route::get('/pagar/{usuario}/{pedido}/{nit}', [PagoFacilController::class, 'RecolectarDatos'])->name('pago_facil.pagar');
    Route::post('/estado/{pedido}', [PagoFacilController::class, 'ConsultarEstado'])->name('pago_facil.estado');
    Route::get('/callback/{pedido}', [PagoFacilController::class, 'urlCallback'])->name('pago_facil.callback');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('productos', ProductoController::class); 