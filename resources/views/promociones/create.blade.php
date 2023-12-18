<x-app-layout>
    @section('title', 'Promociones')

    <div class="main-content">
        <section class="section">
            <div class="loader"></div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Promocion</h4>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center;"
                                class="m-2">
                                <div class="m-4">
                                    <h2 class="mb-0 card-title">Crear Promocion</h2>
                                </div>
                                <div class="float-right" style="padding-right: 40px">
                                    <a href="{{ route('promociones.index') }}" class="btn btn-secondary"
                                        data-placement="left">
                                        {{ __('Atras') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">

                                @if ($errors->any())
                                    <div id="errorModal" class="modal" style="display: block;">
                                        <div class="modal-content">
                                            <span class="close" onclick="cerrarModal('errorModal')">&times;</span>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('promociones.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="producto" class="form-label">Producto</label>
                                        <select class="form-control" id="producto" name="producto">
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first(
                                            'producto_id',
                                            '<span class="help-block text-danger">*:El campo producto es requerido</span>',
                                        ) !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripcion</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                                        {!! $errors->first(
                                            'descripcion',
                                            '<span class="help-block text-danger">*:El campo descripcion es requerido</span>',
                                        ) !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="descuento" class="form-label">Descuento</label>
                                        <input type="text" class="form-control" id="descuento" name="descuento">
                                        {!! $errors->first('descuento', '<span class="help-block text-danger">*:El campo descuento es requerido</span>') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                        <input type="date" class="form-control" id="fecha_inicio"
                                            name="fecha_inicio">
                                        {!! $errors->first(
                                            'fecha_inicio',
                                            '<span class="help-block text-danger">*:El campo fecha de inicio es requerido</span>',
                                        ) !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_fin" class="form-label">Fecha de fin</label>
                                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                                        {!! $errors->first(
                                            'fecha_fin',
                                            '<span class="help-block text-danger">*:El campo fecha de fin es requerido</span>',
                                        ) !!}
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


    <script>
        // Función para cerrar el modal
        function cerrarModal(idModal) {
            document.getElementById(idModal).style.display = 'none';
        }
    </script>
    
</x-app-layout>
