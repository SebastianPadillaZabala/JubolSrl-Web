<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="sticky navbar navbar-expand-lg main-navbar">
                <div class="form-inline me-auto">
                    <ul class="mr-3 navbar-nav">
                        <li><a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                        <li>

                            <div class="search-element">
                                <input class="form-control" type="search" id="search" placeholder="Buscar.." aria-label="Search">
                                <ul id="search-results"></ul>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <span class="text-dark">{{ auth()->user()->nombre }}</span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Bienvenido {{ auth()->user()->nombre }}</div>
                            <a href="{{ route('profile.show') }}" class="dropdown-item has-icon"> <i class="far fa-user"></i> Perfil</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf


                                <a href="route('logout')" onclick="event.preventDefault();
                    this.closest('form').submit();" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i>Cerrar
                                    Sesión</a>


                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('home') }}"> <img alt="image" src="{{ asset('assets/img/logojugosplantilla.png') }}" class="header-logo" />
                            <span class="logo-name">JUBOL</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Menu</li>
                        <li class="dropdown">
                            <a href="{{ route('dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>
                        @if (auth()->user()->rol_id == 1)
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Usuarios</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                            </ul>
                        </li>
                        @endif

                        @if (auth()->user()->rol_id == 1 || auth()->user()->rol_id == 2)
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="tag"></i><span>Productos</span></a>
                            <ul class="dropdown-menu">


                                <li><a class="nav-link" href="{{route('productos.index')}}">Lista de Productos</a></li>

                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="percent"></i><span>Promociones</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{route('promociones.index')}}">Lista de Promociones</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="bar-chart-2"></i><span>Estadisticas</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{route('estadisticas1')}}">Estadisticas 1</a></li>
                                <li><a class="nav-link" href="{{route('estadisticas2')}}">Estadisticas 2</a></li>
                                <li><a class="nav-link" href="{{route('estadisticas3')}}">Estadisticas 3</a></li>
                                <li><a class="nav-link" href="{{route('estadisticas4')}}">Estadisticas 4</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="dollar-sign"></i><span>Pagos</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{route('pagos.index')}}">Lista de Pagos</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Facturas</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{route('facturas.index')}}">Lista de Facturas</a></li>
                            </ul>
                        </li>
                        @endif
                        @if(auth()->user()->rol_id == 3)
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="dollar-sign"></i><span>Pagos</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{route('indexPagoClient')}}">Lista de Pagos</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Facturas</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{route('indexFacturaClient')}}">Lista de Facturas</a></li>
                            </ul>
                        </li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-cart"></i><span>Shopping</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{route('home')}}">Ecommerce</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>

            {{ $slot }}

            <div class="settingSidebar">
                <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                </a>
                <div class="settingSidebar-body ps-container ps-theme-default">
                    <div class=" fade show active">
                        <div class="setting-panel-header">Configuración
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Seleccionar diseño</h6>
                            <div class="selectgroup layout-color w-50">
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                                    <span class="selectgroup-button">Light</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                                    <span class="selectgroup-button">Dark</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Color de la barra lateral</h6>
                            <div class="selectgroup selectgroup-pills sidebar-color">
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                                    <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                                    <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Tema de color Infantil</h6>
                            <div class="theme-setting-options">
                                <ul class="mb-0 choose-theme list-unstyled">
                                    <li title="orange">
                                        <div class="orange"></div>
                                    </li>
                                    <li title="red">
                                        <div class="red"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Tema de color Jovenes</h6>
                            <div class="theme-setting-options">
                                <ul class="mb-0 choose-theme list-unstyled">
                                    <li title="black">
                                        <div class="black"></div>
                                    </li>
                                    <li title="green">
                                        <div class="green"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Tema de color Adulto</h6>
                            <div class="theme-setting-options">
                                <ul class="mb-0 choose-theme list-unstyled">
                                    <li title="white" class="active">
                                        <div class="white"></div>
                                    </li>
                                    <li title="black">
                                        <div class="black"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <div class="theme-setting-options">
                                <label class="m-b-0">
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="control-label p-l-10">Mini Sidebar</span>
                                </label>
                            </div>
                        </div>

                        <div class="p-3 mt-4 mb-4 align-center rt-sidebar-last-ele">
                            <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                <i class="fas fa-undo"></i> Restaurar predeterminado
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<style>
    .search-element {
        position: relative;
    }

    #search-results {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        list-style: none;
        padding: 0;
        margin: 0;
        max-height: 200px;
        /* Ajusta la altura máxima según tus necesidades */
        overflow-y: auto;
        /* Habilita el desbordamiento vertical con scroll */
    }

    #search-results li {
        padding: 10px;
        border-bottom: 1px solid #eee;
        transition: background-color 0.3s;
        cursor: pointer;
    }

    #search-results li:hover {
        background-color: #f8f8f8;
    }
</style>

<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            var query = $(this).val();

            if (query.length > 4) { // Realizar búsqueda solo si la consulta es lo suficientemente larga
                search(query);
            } else {
                $('#search-results').empty(); // Limpiar resultados si la consulta es corta
            }
        });

        function search(query) {
            $.ajax({
                method: 'GET',
                url: '/inf513/grupo14sa/JubolSrl-Web/public/search', // Ruta en Laravel para manejar la búsqueda
                data: {
                    query: query
                },
                success: function(response) {
                    displayResults(response);
                },
                error: function(error) {
                    console.error('Error en la búsqueda:', error);
                }
            });
        }

        function displayResults(results) {
            var $searchResults = $('#search-results');
            $searchResults.empty();

            if (results.length === 0) {
                $searchResults.append('<li>Sin resultados</li>');
            } else {
                results.forEach(function(result) {
                    if (result.nombre !== undefined) {
                        var listItem;
                        if (result.tipo === 'usuario') {
                            listItem = '<li><a href="/inf513/grupo14sa/JubolSrl-Web/public/usuarios/' + result.id + '">' + result.nombre + '</a></li>';
                        } else if (result.tipo === 'producto') {
                            listItem = '<li><a href="/inf513/grupo14sa/JubolSrl-Web/public/productos/' + result.id + '">' + result.nombre + '</a></li>';
                        } 
                        $searchResults.append(listItem);
                    }
                    if (result.descripcion !== undefined) {
                        if (result.tipo === 'promocion') {
                            listItem = '<li><a href="/inf513/grupo14sa/JubolSrl-Web/public/promociones/' + result.id + '">' + result.descripcion + '</a></li>';
                            $searchResults.append(listItem);
                        }
                    }
                });
            }
        }
    });
</script>