<x-app-layout>
    @section('title', 'Usuarios')

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

                            <div style="display: flex; justify-content: space-between; align-items: center;" class="m-2">
                                <div class="m-4">
                                    <h2 class="mb-0 card-title">Crear Usuario</h2>
                                </div>
                                <div class="float-right" style="padding-right: 40px">
                                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary" data-placement="left">
                                        {{ __('Atras') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('usuarios.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+">
                                        @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="direccion" class="form-label">Direccion</label>
                                        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" required>
                                        @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Telefono</label>
                                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" required>
                                        @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="rol" class="form-label">Rol</label>
                                        <select class="form-control" id="rol" name="rol">
                                            @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('rol_id', '<span class="help-block text-danger">*:El campo rol es requerido</span>') !!}
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


</x-app-layout>