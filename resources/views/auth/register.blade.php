<x-guest-layout>

    <body>
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
        <div class="loader"></div>
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div
                            class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h4>Register</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('RegistarCliente') }}" class="needs-validation"
                                        novalidate="">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="frist_name">Nombre</label>
                                                <input id="nombre" type="text" class="form-control"
                                                    name="nombre" autofocus required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="direccion">Direccion</label>
                                                <input id="direccion" type="text" class="form-control"
                                                    name="direccion" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="telefono">Telefono</label>
                                                <input id="telefono" type="text" class="form-control"
                                                    name="telefono" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Correo</label>
                                            <input id="email" type="email" class="form-control" name="email" required>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="password" class="d-block">Contraseña</label>
                                                <input id="password" type="password" class="form-control pwstrength"
                                                    data-indicator="pwindicator" name="password" required>
                                                <div id="pwindicator" class="pwindicator">
                                                    <div class="bar"></div>
                                                    <div class="label"></div>
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="password2" class="d-block">Confirmar Contraseña</label>
                                                <input id="password2" type="password" class="form-control"
                                                    name="password-confirm" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="agree" class="custom-control-input"
                                                    id="agree">
                                                <label class="custom-control-label" for="agree">Estoy de acuerdo con el Términos y condiciones</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning btn-lg btn-block" tabindex="4">
                                                Register
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="mb-4 text-center text-muted">
                                    ¿Ya registrado? <a class="text-warning" href="{{route('login')}}">Iniciar Sesion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</x-guest-layout>
