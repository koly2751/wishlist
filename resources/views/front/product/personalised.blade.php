@extends('front.include.mapp')

@push('css')

<style type="text/css">
    .recipient_img a img {
        border: 1px solid #fff;
        border-radius: 50%;
        background: #fff;


    }

</style>
@endpush



@section('subcategorymenu')

@foreach($subcategories as $key=>$scat)
<li><a href="{{route('usercategories.show', $key)}}">{{ $key }}</a></li>
@endforeach
@endsection


@section('recipent')
@foreach($categories as $category)
<li><a href="{{ route('typee',$category->id)}}">{{ $category->name }}</a></li>
@endforeach
@endsection




@section('content')

<main class="main">
    <div class="mb-5"></div><!-- margin -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb mt-0">
                <li class="breadcrumb-item"><a href="route('home')"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('userproducts.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">personalised</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <nav class="toolbox horizontal-filter">
            <div class="toolbox-left">
                <div class="filter-toggle">
                    <span>Filters:</span>
                    <a href=#>&nbsp;</a>
                </div>
            </div><!-- End .toolbox-left -->

            <div class="toolbox-item toolbox-sort">
                <div class="select-custom">
                    <select name="orderby" class="form-control">
                        <option value="menu_order" selected="selected">Default sorting</option>
                        <option value="popularity">Sort by popularity</option>
                        <option value="rating">Sort by average rating</option>
                        <option value="date">Sort by newness</option>
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </div><!-- End .select-custom -->

                <a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span></a>
            </div><!-- End .toolbox-item -->

            <div class="toolbox-item">
                <div class="toolbox-item toolbox-show">
                    <label>Showing 1–9 of 60 results</label>
                </div><!-- End .toolbox-item -->

                <div class="layout-modes">
                    <a href="#" class="layout-btn btn-grid active" title="Grid">
                        <i class="icon-mode-grid"></i>
                    </a>

                </div><!-- End .layout-modes -->
            </div>
        </nav>

        <div class="row products-body">
            <div class="col-lg-9 main-content">
                <div class="row row-sm">

                    @foreach($oproducts as $product)
                    <div class="col-6 col-md-4">
                        <div class="product">
                            @foreach($product->medias as $media)
                            <figure class="product-image-container">
                                <a href="{{ route('userproducts.show',str_slug("$product->title $product->id"))}}" class="product-image">
                                    <img src="{{ asset("/image_real/medias/product400/product-$media->id.$media->image")}}" alt="product">
                                </a>
                            </figure>
                            @break
                            @endforeach
                            <div class="product-details">
                                <!-- End .product-container -->
                                <h2 class="product-title">
                                    <a href="product.html">{{$product->title}}</a>
                                </h2>
                                <div class="price-box">
                                    <span class="product-price">{{$product->price}}</span>
                                </div><!-- End .price-box -->

                                <div class="product-action">


                                    <input type="hidden" class="qty-{{ $product->id }}" value="1">
                                    <a href="{{ route('userproducts.show',str_slug("$product->title $product->id"))}}" class="paction add-cart" title="Add to Cart">
                                        View Cart
                                    </a>


                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                    </div>
                    @endforeach
                    <!-- End .col-md-4 -->


                </div><!-- End .row -->


                

            </div><!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-1" role="button" aria-expanded="true" aria-controls="widget-body-1">Categories</a>
                        </h3>

                        <div class="collapse show" id="widget-body-1">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach($categories as $category)
                                    <li><a href="{{ route('typee',$category->id)}}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                               

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Brands</a>
                        </h3>

                        <div class="collapse show" id="widget-body-4">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach($brands as $brand)
                                    <li><a href="{{route('brand.index',$brand->name)}}">{{$brand->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

           

                    <div class="widget widget-featured">
                        <h3 class="widget-title">Featured Products</h3>

                        <div class="widget-body">
                            <div class="owl-carousel widget-featured-products">
                                <div class="featured-col">
                                    @php
                                    $c=0;
                                    $products=$featureds->count();
                                    @endphp
                                    @foreach($featureds as $featured)

                                    <div class="product product-sm">
                                        @foreach($featured->medias as $media)
                                        <figure class="product-image-container">
                                            <a href="{{ route('userproducts.show',str_slug("$featured->title $featured->id"))}}" class="product-image">
                                                <img src="{{ asset("/image_real/medias/product400/product-$media->id.$media->image")}}" alt="product">

                                        </figure>

                                        @break
                                        @endforeach
                                        <div class="product-details">
                                            <h2 class="product-title">
                                                <a href="{{ route('userproducts.show',str_slug("$featured->title $featured->id"))}}">{{$featured->title}}</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">৳{{$featured->price}}</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div><!-- End .product -->
                                    @php
                                    $c++;
                                    @endphp
                                    @if($products > 3 && $c == 3)
                                </div>
                                <div class="product product-sm">
                                    @endif
                                    @endforeach

                                </div>

                                <!-- End .featured-col -->
                            </div><!-- End .widget-featured-slider -->
                        </div><!-- End .widget-body -->
                    </div> <!-- End .widget -->

                  
                </div><!-- End .sidebar-wrapper -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main>

@endsection


@push('js')
<script src="{{ asset('ajax/add_to_cart.js') }}"></script>
@endpush
