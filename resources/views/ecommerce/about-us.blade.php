@extends('ecommerce/template')

@section('content')
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Sobre nosotros</h3>
                        <ul>
                            <li><a href="{{route('home')}}">Inicio</a></li>
                            <li>Sobre nosotros</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- About Area Start Here -->
    <div class="about-area mt-no-text">
        <div class="container custom-area">
            <div class="row mb-30 align-items-center">
                <div class="col-md-6 col-custom">
                    <div class="collection-content">
                        <div class="section-title text-left">
                            <h3 class="section-title-3 pb-0">MISIÓN</h3>
                        </div>
                        <div class="desc-content">
                            <p>Satisfacer con excelencia a nuestros clientes a través de bebidas de jugo naturales elaboradas 100% con fruta y generar bienestar en la salud.</p>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-6 col-custom">
                    <!--Single Banner Area Start-->
                    <div class="single-banner hover-style">
                        <div class="banner-img">
                            <a href="#">
                                <img src="assets_ecommerce/images/about/1.jpg" alt="About Image">
                                <div class="overlay-1"></div>
                            </a>
                        </div>
                    </div>
                    <!--Single Banner Area End-->
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6 col-custom order-2 order-md-1">
                    <!--Single Banner Area Start-->
                    <div class="single-banner hover-style">
                        <div class="banner-img">
                            <a href="#">
                                <img src="assets_ecommerce/images/about/2.jpg" alt="About Image">
                                <div class="overlay-1"></div>
                            </a>
                        </div>
                    </div>
                    <!--Single Banner Area End-->
                </div>
                <div class="col-md-6 col-custom order-1 order-md-2">
                    <div class="collection-content">
                        <div class="section-title text-left">
                            <h3 class="section-title-3 pb-0">VISION</h3>
                        </div>
                        <div class="desc-content">
                            <p>Ser la Empresa número 1 y líder en Bolivia, reconocida por la calidad, excelencia operativa y continua innovación, siempre impulsada por el talento de nuestros trabajadores, guiada por el modelo de un negocio que comparte el riesgo y la rentabilidad.</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Area End Here -->



@endsection
