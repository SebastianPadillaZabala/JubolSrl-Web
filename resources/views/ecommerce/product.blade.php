<!--Product Area Start-->
<div class="product-area pt-5">
    <div class="container custom-area-2 overflow-hidden">
        <div class="row">
            <!--Section Title Start-->
            <div class="col-12 col-custom">
                <div class="section-title text-center mb-30">
                    <h3 class="section-title-3">PRODUCTOS DESTACADOS</h3>
                </div>
            </div>
            <!--Section Title End-->
        </div>
        <div class="row product-row">
            <div class="col-12 col-custom">
                <div class="product-slider swiper-container anime-element-multi">
                    <div class="swiper-wrapper">

                        @foreach ($allProducts as $product)
                            <div class="single-item swiper-slide">


                                <!--Single Product Start-->
                                <div class="single-product position-relative mb-30">
                                    <div class="product-image">

                                        <img src="{{ asset('/assets/img/productos') . '/' . $product->imagen }}"
                                            alt="" class="product-image-1 w-100">

                                        @if ($product->descuento > 0)
                                            <span class="onsale">Oferta!</span>
                                        @endif

                                    </div>
                                    <div class="product-content">
                                        <div class="product-title">
                                            <h4 class="title-2"> {{ $product->nombre }}</h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price ">{{ $product->precio_final }}</span>
                                            @if ($product->descuento > 0)
                                                <span class="old-price"><del>{{ $product->precio }}</del></span>
                                            @endif
                                        </div>
                                        <a href="{{route('cart')}}" class="btn product-cart">Añadir al carrito</a>
                                    </div>
                                </div>
                                <!--Single Product End-->
                            </div>
                        @endforeach

                    </div>
                    <!-- Slider pagination -->
                    <div class="swiper-pagination default-pagination"></div>
                    
                    <!-- Slider pagination -->
                    <a href="{{ route('shopEcommerce') }}" class="ver-todos-link">
                        <span>Ver todos los productos</span>
                    </a>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<!--Product Area End-->
