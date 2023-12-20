<x-app-layout>
    @section('title', 'Paginas')

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
                                <h4>Paginas</h4>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center;"
                                class="m-2">
                                <div class="m-4">
                                    <h2 class="mb-0 card-title">Lista de Paginas</h2>
                                </div>                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive data_table">
                                    <table id="example" class="table mytable table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nº</th>
                                                <th>Nombre</th>
                                                <th>Nro Visitas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pageViews as $p)
                                                <tr>
                                                    <td>{{ $p->id }}</td>

                                                    <td>{{ $p->nombre }}</td>
                                                    <td>{{ $p->nro_visitas }}</td>
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
