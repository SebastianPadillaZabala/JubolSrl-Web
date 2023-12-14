@extends('ecommerce/template')

@section('content')



    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Contactanos</h3>
                        <ul>
                            <li><a href="{{route('home')}}">Inicio</a></li>
                            <li>Contactanos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    
        <!-- Contact Us Area Start Here -->
        <div class="contact-us-area mt-no-text">
            <div class="container custom-area">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-custom">
                        <div class="contact-info-item">
                            <div class="con-info-icon">
                                <i class="lnr lnr-map-marker"></i>
                            </div>
                            <div class="con-info-txt">
                                <h4>Nuestra ubicacion</h4>
                                <p>Km 14.5 Carretera a Cotoca, lado Surtidor Tarope, Cotoca, Bolivia, 591</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-custom">
                        <div class="contact-info-item">
                            <div class="con-info-icon">
                                <i class="lnr lnr-smartphone"></i>
                            </div>
                            <div class="con-info-txt">
                                <h4>Contacta con nosotros en cualquier momento</h4>
                                <p>Celular: 60094000</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-custom text-align-center">
                        <div class="contact-info-item">
                            <div class="con-info-icon">
                                <i class="lnr lnr-envelope"></i>
                            </div>
                            <div class="con-info-txt">
                                <h4>Correo</h4>
                                <p>info@jugosbolivianos.com.bo</p>
                            </div>
                        </div>
                    </div>
                </div>
           
            </div>
        </div>
        <!-- Contact Us Area End Here -->



@endsection
