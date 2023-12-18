@extends('ecommerce/template')

@section('content')
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="text-center col-12">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Todos los productos</h3>
                        <ul>
                            <li><a href="{{ route('home') }}">Inicio</a></li>
                            <li>Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->



    <!-- Shop Main Area Start Here -->
    <div class="shop-main-area">
        <div class="container container-default custom-area">
            <div class="col-lg-12 col-12 col-custom widget-mt">
                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper mb-30">
                    <div class="shop_toolbar_btn">
                        <button data-role="grid_3" type="button" class="active btn-grid-3" title="Grid"><i
                                class="fa fa-th"></i></button>
                        <button data-role="grid_list" type="button" class="btn-list" title="List"><i
                                class="fa fa-th-list"></i></button>
                    </div>
                </div>
                <!--shop toolbar end-->

                <!-- Shop Wrapper Start -->
                <div class="row shop_wrapper grid_3">
                    @foreach ($allProducts as $product)
                        <div class="col-md-6 col-sm-6 col-lg-4 col-custom product-area">
                            <div class="product-item">
                                <div class="ml-0 mr-0 single-product position-relative">
                                    <div class="product-image">

                                        <img src="{{ asset('/assets/img/productos') . '/' . $product->imagen }}"
                                            alt="" class="product-image-1 w-100">

                                        @if ($product->descuento > 0)
                                            <span class="onsale">Oferta!</span>
                                        @endif

                                    </div>
                                    <div class="product-content">
                                        <div class="product-title">
                                            <h4 class="title-2"> {{ $product->nombre }}
                                            </h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price ">{{ $product->precio_final }}</span>

                                            @if ($product->descuento > 0)
                                                <span class="old-price"><del>{{ $product->precio }}</del></span>
                                            @endif
                                        </div>
                                        <a href="javascript:void(0);" class="btn product-cart" data-id="{{ $product->id }}"
                                            data-name="{{ $product->nombre }}" data-price="{{ $product->precio }}"
                                            data-finalprice="{{ $product->precio_final }}"
                                            data-image="{{ asset('/assets/img/productos/' . $product->imagen) }}"
                                            data-promocion="{{ $product->descuento > 0 ? 'si' : 'no' }}">
                                            Añadir al carrito
                                        </a>
                                    </div>
                                    <div class="product-content-listview">
                                        <div class="product-title">
                                            <h4 class="title-2"> {{ $product->nombre }}
                                            </h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price ">{{ $product->precio_final }}</span>
                                            @if ($product->descuento > 0)
                                                <span class="old-price"><del>{{ $product->precio }}</del></span>
                                            @endif
                                        </div>
                                        <p class="desc-content">{{ $product->descripcion }}</p>
                                        <a href="javascript:void(0);" class="btn product-cart"
                                            data-id="{{ $product->id }}" data-name="{{ $product->nombre }}"
                                            data-price="{{ $product->precio }}" data-finalprice="{{ $product->precio_final }}"
                                            data-image="{{ asset('/assets/img/productos/' . $product->imagen) }}"
                                            data-promocion="{{ $product->descuento > 0 ? 'si' : 'no' }}">
                                            Añadir al carrito
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Shop Wrapper End -->
            </div>
        </div>
    </div>
    <!-- Shop Main Area End Here -->
@endsection
