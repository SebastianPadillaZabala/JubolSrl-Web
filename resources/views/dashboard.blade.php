@section('title', 'Dashboard')
<x-app-layout>
    <div class="main-content">
        <section class="section">
            @if (auth()->user()->rol_id == 1 || auth()->user()->rol_id == 2)
                <div class="row ">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="card-content">
                                                <h5 class="font-15">Total Usuarios</h5>
                                                <h2 class="mb-3 font-18">{{ $usuarios }}</h2>
                                            </div>
                                        </div>
                                        <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="banner-img">
                                                <img src="{{ asset('assets/img/banner/clientes.avif') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="card-content">
                                                <h5 class="font-15">Total Productos</h5>
                                                <h2 class="mb-3 font-18">{{ $productos }}</h2>
                                            </div>
                                        </div>
                                        <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="banner-img">
                                                <img src="{{ asset('assets/img/banner/transaccion.avif') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="card-content">
                                                <h5 class="font-15">Total Promociones Vigentes</h5>
                                                <h2 class="mb-3 font-18">{{ $promociones }}</h2>
                                            </div>
                                        </div>
                                        <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="banner-img">
                                                <img src="{{ asset('assets/img/banner/cant-tran-2.webp') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="card-content">
                                                <h5 class="font-15">Total Pedidos</h5>
                                                <h2 class="mb-3 font-18">{{ $pedidos }}</h2>
                                            </div>
                                        </div>
                                        <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="banner-img">
                                                <img src="{{ asset('assets/img/banner/ventas.avif') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Pedidos</h4>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive data_table">
                                    <table id="example" class="table mytable table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Cliente</th>
                                                <th>Monto</th>
                                                <th>Descuento</th>
                                                <th>Estado</th>
                                                <th>Metodo de Pago</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($infoPedidos as $pedido)
                                                <tr>
                                                    <td>{{ $pedido->fecha }}</td>
                                                    <td>{{ $pedido->cliente }}</td>
                                                    <td>{{ $pedido->monto_total }} Bs</td>
                                                    <td>{{ $pedido->descuento_total }} Bs</td>
                                                    <td>{{ $pedido->estado == '1' ? 'Pagado' : 'Pendiente' }}</td>
                                                    <td>{{ $pedido->metodo_pago }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            @if (auth()->user()->rol_id == 3)
                <div class="row ">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="card-content">
                                                <h5 class="font-15">Total Pedidos</h5>
                                                <h2 class="mb-3 font-18">{{ $pedidosCliente }}</h2>
                                            </div>
                                        </div>
                                        <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="banner-img">
                                                <img src="{{ asset('assets/img/banner/clientes.avif') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="card-content">
                                                <h5 class="font-15">Total Productos Comprados</h5>
                                                <h2 class="mb-3 font-18">{{ $productosCliente }}</h2>
                                            </div>
                                        </div>
                                        <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="banner-img">
                                                <img src="{{ asset('assets/img/banner/transaccion.avif') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="card-content">
                                                <h5 class="font-15">Total Monto de Pagos</h5>
                                                <h2 class="mb-3 font-18">{{ $pagos }}</h2>
                                            </div>
                                        </div>
                                        <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="banner-img">
                                                <img src="{{ asset('assets/img/banner/cant-tran-2.webp') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="card-content">
                                                <h5 class="font-15">Total Productos Comprados con Promocion</h5>
                                                <h2 class="mb-3 font-18">{{ $compraPromocion }}</h2>
                                            </div>
                                        </div>
                                        <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="banner-img">
                                                <img src="{{ asset('assets/img/banner/ventas.avif') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Pedidos</h4>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive data_table">
                                    <table id="example" class="table mytable table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Cantidad de Productos</th>
                                                <th>Monto</th>
                                                <th>Descuento</th>
                                                <th>Estado</th>
                                                <th>Metodo de Pago</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pedidosUsuario as $pedido)
                                                <tr>
                                                    <td>{{ $pedido->fecha }}</td>
                                                    <td>{{ $pedido->cantidad_productos }}</td>
                                                    <td>{{ number_format($pedido->monto_total, 2) }}</td>
                                                    <td>{{ number_format($pedido->descuento_total, 2) }}</td>
                                                    <td>{{ $pedido->estado == '1' ? 'Pagado' : 'Pendiente' }}</td>
                                                    <td>{{ $pedido->metodo_pago }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif


        </section>
    </div>
</x-app-layout>
