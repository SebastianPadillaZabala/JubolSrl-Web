<x-app-layout>
    @section('title', 'Pagos')

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
                                <h4>Pagos</h4>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center;"
                                class="m-2">
                                <div class="m-4">
                                    <h2 class="mb-0 card-title">Lista de Pagos</h2>
                                </div>                            
                            </div>
                            <div class="card-body">
                                <div class="table-responsive data_table">
                                    <table id="example" class="table mytable table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nº</th>
                                                <th>id</th>
                                                <th>Fecha</th>
                                                <th>Metodo Pago</th>
                                                <th>Monto</th>
                                                <th>Pedido_Id</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pagos as $p)
                                                <tr>
                                                    <td>{{ ++$i }}</td>

                                                    <td>{{ $p->id }}</td>
                                                    <td>{{ $p->fecha }}</td>
                                                    <td>{{ $p->metodo_pago }}</td>
                                                    <td>{{ $p->monto }}</td>
                                                    <td>{{ $p->pedido_id }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning "
                                                            href="{{ route('pagos.show', $p->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> Ver</a>
                                                        <form action="{{ route('pagos.destroy', $p->id) }}"
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
