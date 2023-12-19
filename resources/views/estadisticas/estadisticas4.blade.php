<x-app-layout>
    @section('title', 'Estadisticas')

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
            <div class="section-body">
                <h4>Productos más vendidos en un periodo especifico</h4>


                <form id="formulario">
                    @csrf
                    <div class="row clearfix">
                        <div class="form-group col-md-3">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="fecha_fin">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="producto_id">Producto</label>
                            <select class="form-control" id="producto_id" name="producto_id" required>

                            </select>
                        </div>



                        <div class="form-group col-md-2">
                            <label for="boton">Click para actualizar</label>
                            <button type="submit" class="btn btn-primary" id="boton">Actualizar Datos</button>
                        </div>
                    </div>
                </form>


                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="recent-report__chart">
                                    <canvas id="grafica"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive data_table">
                                    <table id="example" class="table mytable table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ids = [];
        var nombres = [];
        var fechas = [];
        var cantidades = [];
        var montos = [];
        var productos_id = [];
        var productos_nombre = [];

        function limpiarArreglos() {
            ids = [];
            nombres = [];
            fechas = [];
            cantidades = [];
            montos = [];
        }

        function limpiarArreglos2() {
            ids = [];
            nombres = [];
            fechas = [];
            cantidades = [];
            montos = [];
            productos_id = [];
            productos_nombre = [];
        }

        $(document).ready(function() {
            $.ajax({
                url: '/estadisticas4',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: 1
                }
            }).done(function(res) {
                try {
                    limpiarArreglos2();

                    var respuesta = JSON.parse(res);

                    $("#fecha_inicio").val(respuesta.fecha_inicio);
                    $("#fecha_fin").val(respuesta.fecha_fin);
                    $("#producto_id").val(respuesta.producto_id);

                    var consultaLaravel = respuesta.consultaLaravel;

                    if (Array.isArray(consultaLaravel)) {
                        for (var x = 0; x < consultaLaravel.length; x++) {
                            ids.push(consultaLaravel[x].id);
                            fechas.push(consultaLaravel[x].fecha);
                            cantidades.push(consultaLaravel[x].cantidad);
                            montos.push(consultaLaravel[x].monto);
                        }


                        $.ajax({
                            url: '/estProd',
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        }).done(function(productosRes) {
                            try {
                                var listaProductos = JSON.parse(productosRes);

                                // Obtén el elemento select
                                var selectProductos = document.getElementById('producto_id');

                                // Itera sobre la lista de productos y agrega opciones al select
                                for (var i = 0; i < listaProductos.length; i++) {
                                    var producto = listaProductos[i];

                                    var option = document.createElement('option');
                                    option.value = producto.id;
                                    option.text = producto.nombre;

                                    // Agrega la opción al select
                                    selectProductos.add(option);

                                    // Si el id del producto es 1, selecciónalo por defecto
                                    if (producto.id === respuesta.producto_id) {
                                        option.selected = true;
                                    }
                                }
                            } catch (error) {
                                console.error('Error al procesar la respuesta de productos:',
                                    error);
                            }
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            console.error('Error en la solicitud de productos:', textStatus,
                                errorThrown);
                        });


                        generarGrafica();
                    } else {
                        console.error('La respuesta no es un arreglo válido:', respuesta);
                    }
                } catch (error) {
                    console.error('Error al procesar la respuesta:', error);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud:', textStatus, errorThrown);
            });

            $("#formulario").submit(function(event) {
                event.preventDefault(); // Evita que el formulario se envíe normalmente

                var fecha_inicio = $("#fecha_inicio").val();
                var fecha_fin = $("#fecha_fin").val();
                var producto_id = $("#producto_id").val();

                limpiarArreglos();
                $.ajax({
                    url: '/estadisticas4',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: 1,
                        fecha_inicio: fecha_inicio,
                        fecha_fin: fecha_fin,
                        producto_id: producto_id
                    }
                }).done(function(res) {
                    try {
                        var respuesta = JSON.parse(res);

                        var consultaLaravel = respuesta.consultaLaravel;
                        if (Array.isArray(consultaLaravel)) {
                            for (var x = 0; x < consultaLaravel.length; x++) {
                                ids.push(consultaLaravel[x].id);
                                fechas.push(consultaLaravel[x].fecha);
                                cantidades.push(consultaLaravel[x].cantidad);
                                montos.push(consultaLaravel[x].monto);
                            }
                            generarGrafica();
                        } else {
                            console.error('La respuesta no es un arreglo válido:', respuesta);
                        }
                    } catch (error) {
                        console.error('Error al procesar la respuesta:', error);
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud:', textStatus, errorThrown);
                });
            });
        });

        var myChart = null;

        function generarGrafica() {

            // Destruye el gráfico existente si hay alguno
            if (myChart !== null) {
                myChart.destroy();
            }

            const ctx = document.getElementById('grafica').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: fechas,
                    datasets: [{
                        label: 'Monto (Bs)',
                        data: montos,
                        backgroundColor: [
                            'rgba(135, 206, 250, 0.2)',
                            'rgba(50, 205, 50, 0.2)',
                            'rgba(255, 165, 0, 0.2)',
                            'rgba(240, 128, 128, 0.2)',
                            'rgba(218, 112, 214, 0.2)',
                            'rgba(255, 215, 0, 0.2)'
                        ],
                        borderColor: [
                            'rgba(135, 206, 250, 1)',
                            'rgba(50, 205, 50, 1)',
                            'rgba(255, 165, 0, 1)',
                            'rgba(240, 128, 128, 1)',
                            'rgba(218, 112, 214, 1)',
                            'rgba(255, 215, 0, 1)'
                        ],
                        hoverOffset: 4,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var tabla = $("#example tbody");
            tabla.empty();

            for (var x = 0; x < fechas.length; x++) {
                var nuevaFila = "<tr><th>" + fechas[x] + "</th><th>" + cantidades[x] + "</th><th>" + montos[x] +
                    "</th></tr>";
                tabla.append(nuevaFila);
            }
        }
    </script>

</x-app-layout>
