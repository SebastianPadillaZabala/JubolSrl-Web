@extends('ecommerce/template')

@section('content')

    <body>
        <!-- Breadcrumb Area Start Here -->
        <div class="breadcrumbs-area position-relative">
            <div class="container">
                <div class="row">
                    <div class="text-center col-12">
                        <div class="breadcrumb-content position-relative section-content">
                            <h3 class="title-3">Carrito de compras</h3>
                            <ul>
                                <li><a href="{{ route('home') }}">Inicio</a></li>
                                <li>Carrito de compras</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End Here -->
        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper mt-no-text">
            <div class="container custom-area">
                <div class="row">
                    <div class="col-lg-12 col-custom">
                        <!-- Cart Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Imagen</th>
                                        <th class="pro-title">Producto</th>
                                        <th class="pro-price">Precio</th>
                                        <th class="pro-quantity">Cantidad</th>
                                        <th class="pro-subtotal">Subtotal</th>
                                        {{-- <th class="pro-remove">Eliminar</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carrito as $item)
                                        <tr id="cartItem_{{ $item['id'] }}">
                                            <td class="pro-thumbnail"><a href="#"><img class="img-fluid"
                                                        src="{{ $item['image'] }}" alt="Product" /></a></td>
                                            <td class="pro-title"><a href="#">{{ $item['name'] }}</a></td>
                                            <td class="pro-price"><span>Bs. {{ $item['finalPrice'] }}</span></td>
                                            <td class="pro-quantity">{{ $item['quantity'] }}</td>
                                            <td class="pro-subtotal">Bs. {{ $item['finalPrice'] * $item['quantity'] }}</td>
                                            {{-- <td class="pro-remove"><a href="javascript:void(0);"
                                                onclick="removeItemFromCart({{ $item['id'] }})"><i
                                                    class="lnr lnr-trash"></i></a></td> --}}
                                        </tr>
                                    @endforeach




                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="ml-auto col-lg-5 col-custom">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h3>Total Carrito</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr class="total">
                                            <td>Total</td>
                                            <td class="total-amount">Bs. {{ number_format($subtotal, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <form id="pedidoForm" action="{{ route('realizarPedido') }}" method="POST">
                                @csrf
                                <input type="hidden" name="carrito" value="{{ json_encode($carrito) }}">
                                <button type="submit"
                                    class="btn flosun-button primary-btn rounded-0 black-btn w-100">Realizar
                                    Pedido</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Autenticación Requerida</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Debe iniciar sesión para realizar un pedido.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                    </div>
                </div>
            </div>
        </div>


    </body>

    <script>
        document.getElementById('pedidoForm').addEventListener('submit', function(event) {
            event.preventDefault(); 

            if (!@json(Auth::check())) {
                Swal.fire({
                    title: 'Autenticación requerida',
                    text: 'Debe iniciar sesión para realizar un pedido.',
                    icon: 'info',
                    confirmButtonText: 'Iniciar sesión'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
                return;
            }
            this.submit();
        });
    </script>
@endsection
