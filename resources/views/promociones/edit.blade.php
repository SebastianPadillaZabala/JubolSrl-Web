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
                                    <h2 class="mb-0 card-title">Editar Promocion</h2>
                                </div>
                                <div class="float-right" style="padding-right: 40px">
                                    <a href="{{ route('promociones.index') }}" class="btn btn-secondary"
                                        data-placement="left">
                                        {{ __('Atras') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('promociones.update', $promocion->id) }}"
                                    enctype="multipart/form-data">
                                    {{ method_field('PATCH') }}
                                    @csrf
                                    <div class="mb-3">
                                        <label for="producto" class="form-label">Producto</label>
                                        <select class="form-control" id="producto" name="producto">
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}"
                                                    @if ($producto->id == $promocion->producto_id) selected @endif>
                                                    {{ $producto->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('producto', '<span class="help-block text-danger">*:El campo producto es requerido</span>') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripcion</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion"
                                            value="{{ $promocion->descripcion }}">
                                        {!! $errors->first(
                                            'descripcion',
                                            '<span class="help-block text-danger">*:El campo descripcion es requerido</span>',
                                        ) !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="descuento" class="form-label">Descuento</label>
                                        <input type="text" class="form-control" id="descuento" name="descuento"
                                            value="{{ $promocion->descuento }}">
                                        {!! $errors->first('descuento', '<span class="help-block text-danger">*:El campo descuento es requerido</span>') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                            value="{{ $promocion->fecha_inicio }}">
                                        {!! $errors->first(
                                            'fecha_inicio',
                                            '<span class="help-block text-danger">*:El campo fecha de inicio es requerido</span>',
                                        ) !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"
                                            value="{{ $promocion->fecha_fin }}">
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


</x-app-layout>
