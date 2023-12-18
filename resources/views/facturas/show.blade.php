<x-app-layout>
    @section('title', 'Facturas')
    <style>
        .img-rounded {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .img-rounded:hover {
            transform: scale(1.05);
        }
    </style>
    <div class="main-content">
        <section class="section">
            <div class="loader"></div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Factura</h4>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center;" class="m-2">
                                <div class="m-4">
                                    <h2 class="mb-0 card-title">Informacion</h2>
                                </div>
                                <div class="float-right" style="padding-right: 40px">
                                    <a href="{{ route('facturas.index') }}" class="btn btn-secondary" data-placement="left">
                                        {{ __('Atras') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container ">
                                    <table class="table table-striped table-bordered ">
                                        <tbody>
                                            <tr>
                                                <td><strong>Id Factura</strong></td>
                                                <td>{{ $factura->id }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>NIT</strong></td>
                                                <td>{{ $factura->nit }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Nombre Cliente</strong></td>
                                                <td>{{ $factura->nombre_cliente }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Monto Total</strong></td>
                                                <td>{{ $factura->monto }} Bs</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Fecha</strong></td>
                                                <td>{{ $factura->fecha }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pedido ID</strong></td>
                                                <td>{{ $factura->pedido_id }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h2 class="mb-3 card-title">Detalle</h2>
                                    <div class="table-responsive data_table">
                                        <table class="table table-striped table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Producto</th>
                                                    <th>Precio</th>
                                                    <th>Descuento</th>
                                                    <th>Precio Final</th>
                                                    <th>Cantidad</th>
                                                    <th>Importe</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($productos as $producto)
                                                <tr>
                                                    <td>{{ ++$i }}</td>

                                                    <td>{{ $producto->producto->nombre }}</td>
                                                    <td>{{ $producto->precio }}</td>
                                                    <td>{{ $producto->descuento }}</td>
                                                    <td>{{ $producto->precio_final }}</td>
                                                    <td>{{ $producto->cantidad }}</td>
                                                    <td>{{ $producto->importe }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>