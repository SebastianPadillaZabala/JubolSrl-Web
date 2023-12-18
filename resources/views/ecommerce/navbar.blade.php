    <!-- Header Area Start Here -->
    <header class="main-header-area">
        <!-- Main Header Area Start -->
        <div class="main-header header-transparent header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-xl-2 col-md-6 col-6 col-custom">
                        <div class="header-logo d-flex align-items-center">
                            <a href="{{ route('home') }}">
                                <img class="img-full" src="assets_ecommerce/images/logo/logo.png" alt="Header Logo">
                            </a>
                            <a href="{{ route('home') }}">
                                <div class="section-title text-center mt-3">
                                    <h3 class="section-title-3">JUBOL</h3>
                                </div>
                            </a>

                        </div>
                    </div>
                    <div class="col-lg-8 d-none d-lg-flex justify-content-center col-custom">
                        <nav class="main-nav d-none d-lg-flex">
                            <ul class="nav">
                                <li>
                                    <a class="active" href="{{ route('home') }}">
                                        <span class="menu-text"> Inicio</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shopEcommerce') }}">
                                        <span class="menu-text">Productos</span>

                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('about-us') }}">
                                        <span class="menu-text"> Sobre Nostros</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('contact-us') }}">
                                        <span class="menu-text">Contactanos</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-2 col-md-6 col-6 col-custom">
                        <div class="header-right-area main-nav">
                            <ul class="nav">
                                <li class="minicart-wrap">
                                    <a href="#" class="minicart-btn toolbar-btn">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="cart-item_count" id="cart-item-count">0</span>
                                    </a>
                                    <div class="cart-item-wrapper dropdown-sidemenu dropdown-hover-2" id="cart-items">
                                        <div class="single-cart-item">
                                            <div class="cart-img">
                                                <a href="cart.html"><img src="assets_ecommerce/images/cart/1.jpg"
                                                        alt=""></a>
                                            </div>
                                            <div class="cart-text">
                                                <h5 class="title"><a href="cart.html">Odio tortor consequat</a></h5>
                                                <div class="cart-text-btn">
                                                    <div class="cart-qty">
                                                        <span>1×</span>
                                                        <span class="cart-price">$98.00</span>
                                                    </div>
                                                    <button type="button"><i class="ion-trash-b"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="minicart-wrap">
                                    <a href="#">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-submenu dropdown-hover">
                                        @if (auth()->user())
                                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                        @else
                                            <li><a href="{{ route('login') }}">Iniciar Sesion</a></li>
                                            <li><a href="{{ route('register') }}">Registrarse</a></li>
                                        @endif

                                    </ul>
                                </li>


                                <li class="mobile-menu-btn d-lg-none">
                                    <a class="off-canvas-btn" href="#">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Header Area End -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper" id="mobileMenu">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="fa fa-times"></i>
                </div>
                <div class="off-canvas-inner">

                    <!-- mobile menu start -->
                    <div class="mobile-navigation">
                        <!-- mobile menu navigation start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children"><a href="{{ route('home') }}">Inicio</a>
                                </li>
                                <li class="menu-item-has-children"><a href="{{ route('shopEcommerce') }}">Productos</a>
                                </li>
                                <li><a href="{{ route('cart') }}">Carrito</a></a></li>
                                <li><a href="{{ route('about-us') }}">Sobre nosotros</a></a></li>
                                <li><a href="{{ route('contact-us') }}">Contactanos</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->

                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->

    </header>
