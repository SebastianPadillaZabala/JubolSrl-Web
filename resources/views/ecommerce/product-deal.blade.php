<!-- Product Countdown Area Start Here -->
<div class="product-countdown-area mt-text-3">
    <div class="container custom-area">
        <div class="row">
            <!--Section Title Start-->
            <div class="col-12 col-custom">
                <div class="text-center section-title mb-30">
                    <h3 class="section-title-3">Productos en descuento</h3>
                </div>
            </div>
            <!--Section Title End-->
        </div>
        <div class="row product-row">
            <div class="col-12 col-custom">
                <div class="item-carousel-2 swiper-container anime-element-multi product-area">
                    <div class="swiper-wrapper">
                        @foreach ($productsDeal as $productDeal)
                            <div class="single-item swiper-slide">
                                <!--Single Product Start-->
                                <div class="single-product position-relative mb-30">
                                    <div class="product-image">
                                        <img src="{{ asset('/assets/img/productos') . '/' . $productDeal->imagen }}"
                                            alt="" class="product-image-1 w-100">
                                        <span class="onsale">Oferta!</span>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-title">
                                            <h4 class="title-2"> {{ $productDeal->nombre }}
                                            </h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price ">{{ $productDeal->precio_final }}</span>
                                            <span class="old-price"><del>{{ $productDeal->precio }}</del></span>
                                        </div>
                                        <a href="javascript:void(0);" class="btn product-cart"
                                            data-id="{{ $productDeal->id }}" data-name="{{ $productDeal->nombre }}"
                                            data-price="{{ $productDeal->precio }}"
                                            data-finalprice="{{ $productDeal->precio_final }}"
                                            data-image="{{ asset('/assets/img/productos/' . $productDeal->imagen) }}"
                                            data-promocion="si">
                                            Añadir al carrito
                                        </a>
                                    </div>
                                </div>
                                <!--Single Product End-->
                            </div>
                        @endforeach

                    </div>
                    <!-- Slider pagination -->
                    <div class="swiper-pagination default-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Countdown Area End Here -->
