<x-app-layout>
    @section('title', 'Usuarios')
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
                                <h4>Usuario</h4>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center;"
                                class="m-2">
                                <div class="m-4">
                                    <h2 class="mb-0 card-title">Informacion</h2>
                                </div>
                                <div class="float-right" style="padding-right: 40px">
                                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary"
                                        data-placement="left">
                                        {{ __('Atras') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container ">
                                    <table class="table table-striped table-bordered ">
                                        <tbody>
                                            <tr>
                                                <td><strong>Id Usuario</strong></td>
                                                <td>{{ $usuario->id }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Nombre</strong></td>
                                                <td>{{ $usuario->nombre }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email</strong></td>
                                                <td>{{ $usuario->email }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Direccion</strong></td>
                                                <td>{{ $usuario->direccion }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Telefono</strong></td>
                                                <td>{{ $usuario->telefono }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Rol</strong></td>
                                                <td>{{ $usuario->rol->nombre }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
