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
                            <label for="limit">Top de productos</label>
                            <input type="number" class="form-control" id="limit" name="limit" required>
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
                                                <th>Nro</th>
                                                <th>Producto</th>
                                                <th>Total</th>
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
        var nombres = [];
        var totales = [];

        function limpiarArreglos() {
            nombres = [];
            totales = [];
        }

        $(document).ready(function() {
            $.ajax({
                url: '/inf513/grupo14sa/JubolSrl-Web/public/estadisticas3',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: 1
                }
            }).done(function(res) {
                try {
                    limpiarArreglos();
                    
                    var respuesta = JSON.parse(res);

                    $("#fecha_inicio").val(respuesta.fecha_inicio);
                    $("#fecha_fin").val(respuesta.fecha_fin);
                    $("#limit").val(respuesta.limit);

                    var consultaLaravel = respuesta.consultaLaravel;

                    if (Array.isArray(consultaLaravel)) {
                        for (var x = 0; x < consultaLaravel.length; x++) {
                            nombres.push(consultaLaravel[x].nombre);
                            totales.push(consultaLaravel[x].total);
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

            $("#formulario").submit(function(event) {
                event.preventDefault(); // Evita que el formulario se envíe normalmente

                var fecha_inicio = $("#fecha_inicio").val();
                var fecha_fin = $("#fecha_fin").val();
                var limit = $("#limit").val();

                limpiarArreglos();
                $.ajax({
                    url: '/inf513/grupo14sa/JubolSrl-Web/public/estadisticas3',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: 1,
                        fecha_inicio: fecha_inicio,
                        fecha_fin: fecha_fin,
                        limit: limit
                    }
                }).done(function(res) {
                    try {
                        var respuesta = JSON.parse(res);

                        var consultaLaravel = respuesta.consultaLaravel;
                        if (Array.isArray(consultaLaravel)) {
                            for (var x = 0; x < consultaLaravel.length; x++) {
                                nombres.push(consultaLaravel[x].nombre);
                                totales.push(consultaLaravel[x].total);
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
                    labels: nombres,
                    datasets: [{
                        label: 'Cantidad',
                        data: totales,
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

            for (var x = 0; x < nombres.length; x++) {
                var nuevaFila = "<tr><th>" + (x+1) + "</th><th>" + nombres[x] + "</th><th>" + totales[x] + "</th></tr>";
                tabla.append(nuevaFila);
            }
        }
    </script>

</x-app-layout>
