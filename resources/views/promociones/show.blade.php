<x-app-layout>
  @section('title', 'Promociones')
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
                              <h4>Promocion</h4>
                          </div>

                          <div style="display: flex; justify-content: space-between; align-items: center;"
                              class="m-2">
                              <div class="m-4">
                                  <h2 class="mb-0 card-title">Informacion</h2>
                              </div>
                              <div class="float-right" style="padding-right: 40px">
                                  <a href="{{ route('promociones.index') }}" class="btn btn-secondary"
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
                                              <td><strong>Id Promocion</strong></td>
                                              <td>{{ $promocion->id }}</td>
                                          </tr>
                                          <tr>
                                              <td><strong>Descripcion</strong></td>
                                              <td>{{ $promocion->descripcion }}</td>
                                          </tr>
                                          <tr>
                                              <td><strong>Descuento %</strong></td>
                                              <td>{{ $promocion->descuento }}</td>
                                          </tr>
                                          <tr>
                                              <td><strong>Fecha de inicio</strong></td>
                                              <td>{{ $promocion->fecha_inicio }}</td>
                                          </tr>
                                          <tr>
                                              <td><strong>Fecha de fin</strong></td>
                                              <td>{{ $promocion->fecha_fin }}</td>
                                          </tr>
                                          <tr>
                                              <td><strong>Producto</strong></td>
                                              <td>{{ $promocion->producto->nombre }}</td>
                                          </tr>
                                          <tr>
                                            <td><strong>Imagen</strong></td>
                                            <td> <img class="img-rounded"
                                                    src="{{ asset('/assets/img/productos') . '/' . $promocion->producto->imagen }}"
                                                    alt="" width="250px" height="250px"></td>
                                            </td>
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
