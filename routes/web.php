<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagoFacilController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PersonalMiddleware;

use App\Models\Producto;
use App\Models\Promocion;

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

// Route::get('/', function () {
//     return view('ecommerce/home');
// })->name('home');

Route::get('/test', function () {
    return view('test');
});

Route::post('/IniciarSesion', [UsuarioController::class, 'login'])
    ->name('IniciarSesion');

Route::post('/RegistrarCliente', [UsuarioController::class, 'register_Client'])
    ->name('RegistarCliente');


Route::group(['prefix' => 'pago_facil'], function () {
    Route::get('/pagar/{usuario}/{pedido}/{nit}', [PagoFacilController::class, 'RecolectarDatos'])->name('pago_facil.pagar');
    Route::post('/estado/{pedido}', [PagoFacilController::class, 'ConsultarEstado'])->name('pago_facil.estado');
    Route::get('/callback/{pedido}', [PagoFacilController::class, 'urlCallback'])->name('pago_facil.callback');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
});

Route::middleware(['auth', 'admin-personal'])->group(function () {
    Route::resource('productos', ProductoController::class);
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/about-us', function () {
    return view('ecommerce/about-us');
})->name('about-us');

Route::get('/contact-us', function () {
    return view('ecommerce/contact-us');
})->name('contact-us');

Route::get('/cart', [CarritoController::class, 'cart'])
    ->name('cart');

Route::post('/realizarPedido', [CarritoController::class, 'realizarPedido'])
    ->middleware('auth')
    ->name('realizarPedido');



Route::get('/', [ProductoController::class, 'productEcommerce'])
    ->name('home');
Route::get('/shopEcommerce', [ProductoController::class, 'allProductsEcommerce'])
    ->name('shopEcommerce');
