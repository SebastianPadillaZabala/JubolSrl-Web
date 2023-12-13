<x-app-layout>
    @section('title', 'Productos')

    <div class="main-content">
        @if (Session::has('success'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: '{{ Session::get('success') }}'
                })
            </script>
        @elseif (Session::has('error'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: '{{ Session::get('error') }}'
                })
            </script>
        @endif
        <section class="section">
            <div class="loader"></div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Productos</h4>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center;"
                                class="m-2">
                                <div class="m-4">
                                    <h2 class="mb-0 card-title">Lista de Productos</h2>
                                </div>
                                
                                    <div class="float-right" style="padding-right: 40px">
                                        <a href="{{ route('productos.create') }}" class="btn btn-warning"
                                            data-placement="left">
                                            {{ __('Crear Nuevo') }}
                                        </a>
                                    </div>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive data_table">
                                    <table id="example" class="table mytable table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nº</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Imagen</th>
                                                <th>Precio</th>
                                                <th>Stock</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productos as $producto)
                                                <tr>
                                                    <td>{{ ++$i }}</td>

                                                    <td>{{ $producto->nombre }}</td>
                                                    <td>{{ $producto->descripcion }}</td>
                                                    <td><img src="{{ asset('/assets/img/productos') . '/' . $producto->imagen }}"
                                                        lt="" width="80px"></td>
                                                    <td>{{ $producto->precio }}</td>
                                                    <td>{{ $producto->stock }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning "
                                                            href="{{ route('productos.show', $producto->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> Ver</a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('productos.edit', $producto->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> Editar</a>
                                                        <form action="{{ route('productos.destroy', $producto->id) }}"
                                                            method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('¿Estas seguro de eliminar este registro?')"><i
                                                                    class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</x-app-layout>
