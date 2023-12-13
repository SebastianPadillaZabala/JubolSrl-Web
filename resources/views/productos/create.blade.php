<x-app-layout>
    @section('title', 'Productos')

    <div class="main-content">
        <section class="section">
            <div class="loader"></div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Producto</h4>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center;"
                                class="m-2">
                                <div class="m-4">
                                    <h2 class="mb-0 card-title">Crear Producto</h2>
                                </div>
                                <div class="float-right" style="padding-right: 40px">
                                    <a href="{{ route('productos.index') }}" class="btn btn-secondary"
                                        data-placement="left">
                                        {{ __('Atras') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                        {!! $errors->first('nombre', '<span class="help-block text-danger">*:El campo nombre es requerido</span>') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripcion</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                                        {!! $errors->first('descripcion', '<span class="help-block text-danger">*:El campo descripcion es requerido</span>') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Imagen</label>
                                        <input class="form-control" type="file" name="imagen">
                                        {!! $errors->first('imagen', '<span class="help-block text-danger">*:El campo imagen es requerido</span>') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="precio" class="form-label">Precio</label>
                                        <input type="text" class="form-control" id="precio" name="precio">
                                        {!! $errors->first('precio', '<span class="help-block text-danger">*:El campo precio es requerido</span>') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="text" class="form-control" id="stock" name="stock">
                                        {!! $errors->first('stock', '<span class="help-block text-danger">*:El campo stock es requerido</span>') !!}
                                    </div>
                                    <button  type="submit" class="btn btn-primary">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
  

</x-app-layout>
