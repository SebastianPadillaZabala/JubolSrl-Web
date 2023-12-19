@extends('ecommerce/template')

@section('content')
<!-- Breadcrumb Area Start Here -->
<div class="breadcrumbs-area position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="breadcrumb-content position-relative section-content">
                    <h3 class="title-3">Pago del Pedido</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li>Pago</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End Here -->
<!-- cart main wrapper start -->
<div class="checkout-area mt-no-text">
    <div class="container custom-container">
        <div class="row">
            <div class="col-lg-6 col-12 col-custom">
                <form method="POST" action="{{route('pagando', [$pedido->id])}}">
                    @csrf
                    <div class="checkbox-form">
                        <h3>Datos para la Factura</h3>
                        <div class="row">
                            <div class="col-md-6 col-custom">
                                <div class="checkout-form-list">
                                    <label>Nombre <span class="required">*</span></label>
                                    <input id="nombre" name="nombre" type="text">
                                </div>
                            </div>
                            <div class="col-md-6 col-custom">
                                <div class="checkout-form-list">
                                    <label>NIT <span class="required">*</span></label>
                                    <input id="nit" name="nit" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-payment">
                        <button type="submit" class="btn flosun-button secondary-btn black-color rounded-0 w-100">Pago Realizado</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-12 col-custom">
                <div class="your-order">
                    <h3>Tu Pedido</h3>
                    <div class="your-order-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-product-name">Producto</th>
                                    <th class="cart-product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $productos as $p )
                                <tr class="cart_item">
                                    <td class="cart-product-name"> {{$p->producto->nombre}}<strong class="product-quantity">
                                            × {{$p->cantidad}}</strong></td>
                                    <td class="cart-product-total text-center"><span class="amount">Bs{{$p->importe}}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Carrito Subtotal</th>
                                    <td class="text-center"><span class="amount">Bs{{$pedido->monto_total}}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Pedido Total</th>
                                    <td class="text-center"><strong><span class="amount">Bs{{$pedido->monto_total}}</span></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="#payment-1">
                                        <h5 class="panel-title mb-3">
                                            <a href="#" class="" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Codigo QR
                                            </a>
                                        </h5>
                                    </div>
                                    <img src="data:image/png;base64,{{ base64_encode($qr->getContent()) }}" width="300px" alt="">
                                </div>
                                <div class="card">
                                    <div class="card-header" id="#payment-2">
                                        <h5 class="panel-title mb-3">
                                            <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection