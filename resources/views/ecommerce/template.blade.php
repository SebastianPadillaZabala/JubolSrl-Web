<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Jubol SRL - Jugos Bolivianos</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets_ecommerce/images/favicon.ico">

    <!-- CSS
 ============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets_ecommerce/css/vendor/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="assets_ecommerce/css/vendor/font.awesome.min.css">
    <!-- Linear Icons CSS -->
    <link rel="stylesheet" href="assets_ecommerce/css/vendor/linearicons.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="assets_ecommerce/css/plugins/swiper-bundle.min.css">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets_ecommerce/css/plugins/animate.min.css">
    <!-- Jquery ui CSS -->
    <link rel="stylesheet" href="assets_ecommerce/css/plugins/jquery-ui.min.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="assets_ecommerce/css/plugins/nice-select.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets_ecommerce/css/plugins/magnific-popup.css">
    
    <!-- Main Style CSS -->
    {{-- <link rel="stylesheet" href="assets_ecommerce/css/style.css"> --}}
    <link rel="stylesheet" href="assets_ecommerce/css/style.css" id="theme-style">

    <script src="assets/js/cart.js"></script>

    @include('ecommerce/navbar')



</head>

<body>

    @yield('content')

    @include('ecommerce/footer')

    @include('ecommerce/product-modal')

    <!-- Scroll to Top Start -->
    <a class="scroll-to-top" href="#">
        <i class="lnr lnr-arrow-up"></i>
    </a>
    <!-- Scroll to Top End -->

    <!-- JS
    ============================================ -->

    <!-- Incluir Toastr CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery JS -->
    <script src="assets_ecommerce/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- jQuery Migrate JS -->
    <script src="assets_ecommerce/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <!-- Modernizer JS -->
    <script src="assets_ecommerce/js/vendor/modernizr-3.7.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets_ecommerce/js/vendor/bootstrap.bundle.min.js"></script>

    <!-- Swiper Slider JS -->
    <script src="assets_ecommerce/js/plugins/swiper-bundle.min.js"></script>
    <!-- nice select JS -->
    <script src="assets_ecommerce/js/plugins/nice-select.min.js"></script>
    <!-- Ajaxchimpt js -->
    <script src="assets_ecommerce/js/plugins/jquery.ajaxchimp.min.js"></script>
    <!-- Jquery Ui js -->
    <script src="assets_ecommerce/js/plugins/jquery-ui.min.js"></script>
    <!-- Jquery Countdown js -->
    <script src="assets_ecommerce/js/plugins/jquery.countdown.min.js"></script>
    <!-- jquery magnific popup js -->
    <script src="assets_ecommerce/js/plugins/jquery.magnific-popup.min.js"></script>

    <!-- Main JS -->
    <script src="assets_ecommerce/js/main.js"></script>


</body>



</html>
