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
                <h4>Monto total de ventas diarias en un rango de fechas</h4>


                <form id="formulario">
                    @csrf
                    <div class="row clearfix">
                        <div class="form-group col-md-4">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fecha_fin">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
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
                                                <th>Fecha</th>
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
        var fechas = [];
        var totales = [];

        function limpiarArreglos() {
            fechas = [];
            totales = [];
        }

        $(document).ready(function() {
            $.ajax({
                url: '/estadisticas2',
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

                    var consultaLaravel = respuesta.consultaLaravel;

                    if (Array.isArray(consultaLaravel)) {
                        for (var x = 0; x < consultaLaravel.length; x++) {
                            fechas.push(consultaLaravel[x].fecha);
                            totales.push(consultaLaravel[x].total);
                        }
                        generarGrafica();
                    } else {
                        console.error('La respuesta no es un arreglo válido:', arreglo);
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

                limpiarArreglos();
                $.ajax({
                    url: '/estadisticas2',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: 1,
                        fecha_inicio: fecha_inicio,
                        fecha_fin: fecha_fin
                    }
                }).done(function(res) {
                    try {
                        var respuesta = JSON.parse(res);
                        var consultaLaravel = respuesta.consultaLaravel;
                        if (Array.isArray(consultaLaravel)) {
                            for (var x = 0; x < consultaLaravel.length; x++) {
                                fechas.push(consultaLaravel[x].fecha);
                                totales.push(consultaLaravel[x].total);
                            }
                            generarGrafica();
                        } else {
                            console.error('La respuesta no es un arreglo válido:', arreglo);
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

            console.log("que epx");
            myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: fechas,
                    datasets: [{
                        label: 'Monto(Bs)',
                        data: totales,
                        pointStyle: 'circle',
                        pointRadius: 10,
                        pointHoverRadius: 15
                    }]
                },
            });

            var tabla = $("#example tbody");
            tabla.empty();

            for (var x = 0; x < fechas.length; x++) {
                var nuevaFila = "<tr><th>" + (x + 1) + "</th><th>" + fechas[x] + "</th><th>" + totales[x] + "</th></tr>";
                tabla.append(nuevaFila);
            }
        }
    </script>

</x-app-layout>
