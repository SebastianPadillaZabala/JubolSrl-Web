@extends('ecommerce/template')

@section('content')
<!-- Breadcrumb Area Start Here -->
<div class="breadcrumbs-area position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="breadcrumb-content position-relative section-content">
                    <h3 class="title-3">Factura del Pedido</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li>Factura</li>
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
                <div class="checkbox-form">
                    <h3>Tu Factura</h3>
                    <div class="row">
                        <div class="col-md-6 col-custom">
                            <div class="checkout-form-list">
                                <label> Nombre <span class="required"></span></label>
                                <input id="nombre" name="nombre" value="{{$factura[0]['nombre_cliente']}}" readonly type="text">
                            </div>
                        </div>
                        <div class="col-md-6 col-custom">
                            <div class="checkout-form-list">
                                <label> NIT <span class="required"></span></label>
                                <input id="nit" name="nit" value="{{$factura[0]['nit']}}" readonly type="text">
                            </div>
                        </div>
                        <div class="order-button-payment">
                            <button onclick="window.print()" class="btn flosun-button secondary-btn black-color rounded-0 w-100">IMPRIMIR</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 col-custom">
                <div class="your-order">
                    <h3>Detalle de la Factura</h3>
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
                                    <th>Monto Subtotal</th>
                                    <td class="text-center"><span class="amount">Bs{{$factura[0]['monto']}}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Monto Total</th>
                                    <td class="text-center"><strong><span class="amount">Bs{{$factura[0]['monto']}}</span></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection