<x-app-layout>
    @section('title', 'Promociones')

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
                                <h4>Promociones</h4>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center;"
                                class="m-2">
                                <div class="m-4">
                                    <h2 class="mb-0 card-title">Lista de Promociones</h2>
                                </div>

                                <div class="float-right" style="padding-right: 40px">
                                    <a href="{{ route('promociones.create') }}" class="btn btn-warning"
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
                                                <th>Descripcion</th>
                                                <th>Descuento %</th>
                                                <th>Fecha de inicion</th>
                                                <th>Fecha de Fin</th>
                                                <th>Producto</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($promociones as $promocion)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $promocion->descripcion }}</td>
                                                    <td>{{ $promocion->descuento }}</td>
                                                    <td>{{ $promocion->fecha_inicio }}</td>
                                                    <td>{{ $promocion->fecha_fin }}</td>
                                                    <td>{{ $promocion->producto }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning "
                                                            href="{{ route('promociones.show', $promocion->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> Ver</a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('promociones.edit', $promocion->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> Editar</a>
                                                        <form action="{{ route('promociones.destroy', $promocion->id) }}"
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
