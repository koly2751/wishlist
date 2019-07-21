@extends('front.include.mapp')



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
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('userproducts.index')}}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$products->title}}</li>
            </ol>
        </div><!-- End .container -->
         
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="product-single-container product-single-default">

                    <div class="row">

                        <div class="col-lg-7 col-md-6 product-single-gallery">
                            <div class="product-slider-container product-item">
                                <div class="product-single-carousel owl-carousel owl-theme">

                                    <!--reapeat-->


                                    @foreach($products->medias as $media)
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{ asset("/image_real/medias/product400/product-$media->id.$media->image")}}" data-zoom-image="{{ asset("/image_real/medias/product800/product-$media->id.$media->image")}}" />
                                    </div>
                                    @endforeach



                                </div>

                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
                                    <i class="icon-plus"></i>
                                </span>
                            </div>
                            <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>

                                <!--repeat-->

                                @foreach($products->medias as $media)
                                <div class="col-3 owl-dot">
                                    <img src="{{ asset("/image_real/medias/product400/product-$media->id.$media->image")}}" />
                                </div>
                                @endforeach

                            </div>
                        </div><!-- End .col-lg-7 -->

                        <div class="col-lg-5 col-md-6">
                            <div class="product-single-details">
                                <h1 class="product-title">{{$products['title']}}</h1>

                                <div class="ratings-container">
                                    @php 

                                            $star=0;
                                            if($products->reviews->count() > 0){
                                            $star = round($products->reviews->sum('star')/$products->reviews->count(), 1)*(100/5);
                                            }
                                            @endphp
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{$star}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->

                                            <a href="#product-reviews-content" class="rating-link" aria-controls="product-reviews-content">( {{$products->reviews->count()}} Reviews )</a>
                                        </div>

                                <div class="price-box">

                                    <span class="product-price">৳{{$products->price}}</span>
                                </div><!-- End .price-box -->

                                @if(file_exists("app/files/product_short_description/{$products->id}.txt"))
                                <div class="product-desc">
                                    @if(file_exists("app/files/product_short_description/{$products->id}.txt"))
                                    <p>{!! File::get(storage_path("app/files/product_short_description/{$products->id}.txt")) !!} </p>
                                    @endif
                                </div><!-- End .product-desc -->
                                @endif
                                @if($products->colors->count() > 0)
                                <div class="product-filters-container">
                                    <div class="product-single-filter">
                                        <label>Colors:</label>
                                        <ul class="config-swatch-list">

                                            
                                            @foreach($products->colors as $color)

                                            <li class="">
                                                <input type="radio" name="pcolor" value="{{ $color['id'] }}">
                                                <a style="background-color: {{ $color['name'] }};"></a>

                                            </li>
                                            @endforeach
                                           

                                        </ul>
                                    </div><!-- End .product-single-filter -->
                                </div><!-- End .product-filters-container -->
                                 @endif

                                 @if($products->colors->count() > 0)
                                <div class="product-filters-container">
                                    <div class="product-single-filter">
                                        <label>Size:</label>
                                        @foreach($products->sizes as $size)
                                        <label> <input type="radio" name="size" value="{{ $size->id }}">{{ $size->name }}</label>
                                        @endforeach


                                    </div>
                                </div>
                                 @endif

                                <div class="product-action product-all-icons">
                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control qty-{{ $products->id }}" type="text">
                                    </div><!-- End .product-single-qty -->
                                    <a href="#" class="paction add-cart" title="Add to Cart" onclick="add_to_cart(event, {{ $products->id }})">
                                        Add to Cart
                                    </a>

                                </div><!-- End .product-action -->

                                <div class="product-single-share">
                                    <label>Share:</label>
                                    <div class="addthis_inline_share_toolbox"></div>
                                    <!-- www.addthis.com share plugin-->

                                </div><!-- End .product single-share -->
                            </div>

                            <!-- End .product-single-details -->
                        </div><!-- End .col-lg-5 -->
                    </div>
                    <!-- End .row -->
                </div><!-- End .product-single-container -->

                <!--                        wrap section start-->



                <div class="product-single-tabs">
                    <div class="">
                        <h3>Want to wrap this product? Choose a design from here! </h3>
                    </div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-wrap-desc" data-toggle="tab" href="#product-wrap-content" role="tab" aria-controls="product-wrap-content" aria-selected="true">Wraps and BOXES</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <!--                               wrapping carousel startr-->
                        <div class="tab-pane fade show active" id="product-wrap-content" role="tabpanel" aria-labelledby="product-wrap-desc">

                            <div class="partners-carousel carousel-padding owl-carousel owl-theme">

                                @foreach($wrapps as $wrapp)
                                <a class="partner">
                                    <img src="{{ asset("/backend/images/wrapps/wrapp-$wrapp->id.$wrapp->image") }}" alt="logo">
                                    <input type="radio" name="wrapping" value="{{ $wrapp->id }}"><span>{{ $wrapp->price }}</span>
                                    @endforeach

                            </div><!-- End .partners-carousel -->
                        </div>

                        <!--  wrapping carousel end-->

                        <!--gift card carousel start-->

                        <!--gift card carousel end-->
                    </div><!-- End .tab-content -->
                </div>


                <!--                        wrap section end-->

                <div class="product-single-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                        </li>

                        <li class="nav-item">
                                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-videos-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Videos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews</a>
                                </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                            <div class="product-desc-content">
                                @if(file_exists("app/files/{$products->id}.txt"))
                                <p>{!! File::get(storage_path("app/files/{$products->id}.txt")) !!}</p>
                                @endif
                                <ul>
                                    <li><i class="icon-ok"></i>Any Product types that You want - Simple, Configurable</li>
                                    <li><i class="icon-ok"></i>Downloadable/Digital Products, Virtual Products</li>
                                    <li><i class="icon-ok"></i>Inventory Management with Backordered items</li>
                                </ul>
                                <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, <br>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- End .tab-pane -->



                        <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                            <div class="product-reviews-content">
                                <div class="collateral-box">
                                    <ul>
                                        <li>Be the first to review this product</li>
                                    </ul>
                                </div><!-- End .collateral-box -->

                                <div class="add-product-review">
                                    <h3 class="text-uppercase heading-text-color font-weight-semibold">WRITE YOUR OWN REVIEW</h3>
                                    <p>How do you rate this product? *</p>

                                    <form action="{{route('review')}}" method="post" >

                                        @csrf
                                        <table class="ratings-table">
                                            <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                    <th>1 star</th>
                                                    <th>2 stars</th>
                                                    <th>3 stars</th>
                                                    <th>4 stars</th>
                                                    <th>5 stars</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Quality</td>
                                                    <td>
                                                <input type="radio" name="star" id="Quality_1" value="1"  class="radio" {{old('star')==1?'checked':''}}>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="star" id="Quality_2" value="2" class="radio"  {{old('star')==2?'checked':''}}>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="star" id="Quality_3" value="3" class="radio"  {{old('star')==3?'checked':''}}>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="star" id="Quality_4" value="4" class="radio"  {{old('star')==4?'checked':''}}>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="star" id="Quality_5" value="5" class="radio"  {{old('star')==5?'checked':''}}>
                                                    </td>
                                                </tr>                                             
                                            </tbody>
                                        </table>                                      
                                        
                                        <div class="form-group mb-2">
                                            <label>Review <span class="required">*</span></label>
                                            <textarea cols="5" rows="6" name="review" class="form-control form-control-sm"  >{{old('review')}}</textarea>
                                        </div><!-- End .form-group -->

                                        <input type="hidden" name="user" value="{{$products->id}}">

                                        <input type="submit" class="btn btn-primary" value="Submit Review">
                                    </form>
                                    
                                </div><!-- End .add-product-review -->
                                    <hr />
                                <div class="collateral-box">
                                    <ul>
                                        <li>Product Reviews:</li>
                                    </ul>
                                    @if($reviews->count() > 0)
                                        @foreach($reviews as $review)
                                        <div class="list-group">
                                          <a href="#" class="list-group-item">
                                           <h4 class="list-group-item-heading">{{$review->user['name']}}  <span class="badge badge-danger" style="border-radius: 50%">( {{$review->star}} {{($review->star == 1) ? 'star' : 'stars'}} )</span></h4>
                                            <p class="list-group-item-text">{{$review->description}}</p>
                                          </a>
                                        
                                    </div>
                                    @endforeach
                                @else

                                <h3>No Reviews</h3>
                                @endif
                                </div><!-- End .collateral-box -->

                            </div><!-- End .product-reviews-content -->
                        </div><!-- End .tab-pane -->
                        <div class="tab-pane fade" id="product-videos-content" role="tabpanel" aria-labelledby="product-tab-videos">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
                            </div>
                        </div><!-- End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .product-single-tabs -->
            </div><!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <div class="sidebar-toggle"><i class="icon-sliders"></i></div>
            <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget widget-brand">

                        <a href="{{route('brand.index',$products->brand->name)}}">
                            <img src="{{ asset('backend/images/brands/brand-'.$products->brand->id.'.'.$products->brand->logo) }}" alt="{{$products->brand->name}}">
                        </a>
                    </div><!-- End .widget -->

                    <div class="widget widget-info">
                        <ul>                           
                            <li>
                                <i class="icon-us-dollar"></i>
                                <h4>100% MONEY<br>BACK GUARANTEE</h4>
                            </li>
                            <li>
                                <i class="icon-online-support"></i>
                                <h4>ONLINE<br>SUPPORT 24/7</h4>
                            </li>
                        </ul>
                    </div><!-- End .widget -->

                    <!-- End .widget -->

                    <div class="widget widget-featured">
                        <h3 class="widget-title">Featured Products</h3>

                        <div class="widget-body">
                            <div class="owl-carousel widget-featured-products">
                                <div class="featured-col">
                                    @php
                                    $c=0;
                                    $productss=$featureds->count();
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
                                            <div class="ratings-container">
                                                @php 

                                                $star=0;
                                                if($featured->reviews->count() > 0){
                                                $star = round($featured->reviews->sum('star')/$featured->reviews->count(), 1)*(100/5);
                                                }
                                                @endphp
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:{{$star}}%"></span><!-- End .ratings -->
                                                </div><!-- End .product-ratings -->

                                                <a href="#product-reviews-content" class="rating-link" aria-controls="product-reviews-content">( {{$featured->reviews->count()}} Reviews )</a>
                                            </div>
                                        </div><!-- End .product-details -->
                                    </div><!-- End .product -->
                                    @php
                                    $c++;
                                    @endphp
                                    @if($productss > 3 && $c == 3)
                                </div>
                                <div class="product product-sm">
                                    @endif
                                    @endforeach

                                </div>



                                <!-- End .featured-col -->
                            </div><!-- End .widget-featured-slider -->
                        </div><!-- End .widget-body -->
                    </div><!-- End .widget -->
                </div>
            </aside><!-- End .col-md-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="featured-section">
        <div class="container">
            <h2 class="carousel-title">Related Products</h2>

            <div class="featured-products owl-carousel owl-theme owl-dots-top">

                @foreach($rproducts as $rproduct)
                @if($rproduct->id != $products['id'])

                <div class="product">
                    @foreach($rproduct->medias as $media)
                    <figure class="product-image-container">
                        <a href="{{ route('userproducts.show',str_slug("$rproduct->title $rproduct->id"))}}" class="product-image">
                            <img src="{{ asset("/image_real/medias/product400/product-$media->id.$media->image")}}" alt="product">
                        </a>                       
                    </figure>
                    @break
                    @endforeach
                    <div class="product-details">
                        <!-- End .product-container -->
                       <div class="ratings-container">
                        @php 

                        $star=0;
                        if($rproduct->reviews->count() > 0){
                        $star = round($rproduct->reviews->sum('star')/$rproduct->reviews->count(), 1)*(100/5);
                        }
                        @endphp
                        <div class="product-ratings">
                            <span class="ratings" style="width:{{$star}}%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->

                        <a href="#product-reviews-content" class="rating-link" aria-controls="product-reviews-content">( {{$rproduct->reviews->count()}} Reviews )</a>
                    </div>


                        <h2 class="product-title">
                            <a href="{{route('userproducts.show',str_slug("$rproduct->title $rproduct->id"))}}">{{$rproduct->title}}</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">{{$rproduct->price}}</span>
                        </div><!-- End .price-box -->

                        <div class="product-action">
                            <a href="{{ route('userproducts.show',str_slug("$rproduct->title $rproduct->id"))}}" class="paction add-cart" title="Add to Cart">
                                <span>View Cart</span>
                            </a>

                        </div><!-- End .product-action -->
                    </div><!-- End .product-details -->
                </div>
                <!-- End .product -->
                @endif
                @endforeach

                <!-- End .product -->
            </div><!-- End .featured-proucts -->
        </div><!-- End .container -->
    </div><!-- End .featured-section -->
</main>
@endsection

@push('js')
<script src="{{ asset('ajax/add_to_cart.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
