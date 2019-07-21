@extends('front.include.mapp')

@push('css')

<style type="text/css">
    
  .recipient_img a img{
   border: 1px solid #fff;
   border-radius: 50%;
   background: #fff;
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
            <div class="home-slider-container">
                <div class="home-slider owl-carousel owl-theme owl-theme-light">

                @foreach($sliders as $slider)
                    <div class="home-slide">
                        <div class="slide-bg owl-lazy" data-src='{{ asset("/backend/images/offer/offer-$slider->id.$slider->logo") }}'>
                            
                        </div><!-- End .slide-bg -->
                       
                    </div><!-- End .home-slide -->

                   @endforeach
                </div><!-- End .home-slider -->
            </div>

            <!-- End .home-slider-container -->

            <div class="info-boxes-container">
                <div class="container">
                    <div class="info-box">
                        <i class="icon-shipping"></i>

                        <div class="info-box-content">
                            <h4> <TABLE>TRUSTABLE SHIPPING</TABLE></h4>
                            <p>trust-able shipping for our clients</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->

                    <div class="info-box">
                        <i class="icon-us-dollar"></i>

                        <div class="info-box-content">
                            <h4>MONEY BACK GUARANTEE</h4>
                            <p>100% money back guarantee</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->

                    <div class="info-box">
                        <i class="icon-support"></i>

                        <div class="info-box-content">
                            <h4>ONLINE SUPPORT 24/7</h4>
                            <p>online support 24 hour</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                </div><!-- End .container -->
            </div><!-- End .info-boxes-container -->
            

        <div class="recipient-category " style="padding: 20px 0px;">
               <!-- recipient category starts -->
               <div class="container">
                   <div class="row">
                       <div class="col-md-12">
                           <h2 class="h3 title mb-4 text-center" style="font-size: 22px; padding-bottom: 25px;">Who is the recipient?</h2>
                       </div>
                   </div>
                   <div class="row">
                     @foreach($categories as $category)
                       <div class="col-md-3 col-sm-6 col-3 text-center">
                          <div class="recipient_img"> <a href="{{ route('typee',$category->id)}}"><img src="{{ asset("/backend/images/categories/category-$category->id.$category->image") }}" class="img-fluid"></a></div>
                         <div class="recipient_title">
                              <a href="{{ route('typee',$category->id)}}" style="text-decoration: none;"><h4 style="padding-top: 15px;padding-bottom: 15px; color: #E31E27;">{{ $category->name }}</h4></a>
                          </div>

                       </div> 
                       @endforeach                   
                         
                   </div>
               </div>
           </div><!-- recipient category ends -->



        <!--Product category section start-->

            <div class="category_heading">
                <div class="container">
                    <div class="row border_buttom p-0">
                        <div class="col-lg-4">
                            <h2 class="h3 mb-4 title text-left">Recommanded Product</h2>
                        </div>
                        <div class="col-lg-6"></div>
                        <div class="col-lg-2 text-right"><span><a href="{{route('userproducts.index')}}" style="text-decoration: none; color:#E31E27;font-weight:600; ">View more</a></span></div>
                    </div>

                </div>
            </div>

            <div class="carousel-section">
                <div class="container">
                   
                    <div class="new-products owl-carousel owl-theme">
                        @foreach($products as $product)
                        <div class="product">
                            @foreach($product->medias as $media)

                            <figure class="product-image-container">
                                <a href="{{route('userproducts.show',str_slug("$product->title $product->id"))}}" class="product-image">
                                    <img src="{{ asset("/image_real/medias/product400/product-$media->id.$media->image")}}" alt="product">
                          
                                </a>
                                
                            </figure>
                            @break
                            @endforeach
                            <div class="product-details">
                                @php 
                                $star = 0;
                                if($product->reviews->count() > 0){
                                $star = round($product->reviews->sum('star')/$product->reviews->count(), 1)*(100/5);
                                }
                                @endphp
                                <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{$star}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div>

                                        


                            
                            <!-- End .product-container -->
                                <h2 class="product-title">
                                    <a href="{{ route('userproducts.show',str_slug("$product->title $product->id"))}}">{{ $product->title }}</a>
                                </h2>
                                <div class="price-box">
                                    <span class="product-price"> ৳{{$product->price}}</span>
                                </div><!-- End .price-box -->

                                <div class="product-action">
                                        <input type="hidden" class="qty-{{ $product->id }}" value="1">
                                    <a href="{{ route('userproducts.show',str_slug("$product->title $product->id"))}}" class="paction add-cart" title="Add to Cart">
                                       View Item
                                    </a>

                                   
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->

                        @endforeach
                    </div><!-- End .news-proucts -->
                </div><!-- End .container -->
            </div><!-- End .carousel-section -->
        <!--Product category section end-->


            <div class="mb-5"></div><!-- margin -->
            <div class="banners-group">
                <!-- features start -->
                <div class="container">
                    <div class="row">

                         @foreach($offers as $offr)
                        <div class="col-md-6">
                            <div class="banner banner-image">
                                <a href="{{route('offer',$offr->id)}}">
                                    <img src='{{ asset("/backend/images/offer/offer-$offr->id.$offr->logo") }}' alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                        @endforeach

                        <!-- End .col-md-4 -->

                       <!-- End .col-md-4 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- features start -->

        <!--Product category section start-->

        @include('front.include.newarrival')
   <!-- End .carousel-section -->
        <!--Product category section end-->

         <!--Product category section start-->


         @include('front.include.featured')
<!-- End .carousel-section -->
        <!--Product category section end-->
            <div class="mb-5"></div><!-- margin -->
            <div class="banners-group">
                <!-- features start -->
                <div class="container">
                    <div class="row">
                        @foreach($promotions as $promotion)
                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="#">
                                    <img src='{{ asset("/backend/images/offer/offer-$promotion->id.$promotion->logo") }}' alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                        @endforeach
                       
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- features start -->


            <div class="partners-container">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 text-center">
                            <h3>OUR PARTNERS</h3>
                        </div>

                    </div>

                      
                    <div class="partners-carousel owl-carousel owl-theme">

                       
                                @foreach($brands as $brand)
                            <a href="{{route('brand.index',$brand->name)}}" class="partner">
                           
                            <img src="{{ asset("/backend/images/brands/brand-$brand->id.$brand->logo") }}" alt="logo">

                            
                             @endforeach
                        </a>
                       
                       
                      
                
                      
                       
                    </div>
                     <!-- End .partners-carousel -->
                    
                </div><!-- End .container -->
            </div><!-- End .partners-container -->


            <div class="info-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="feature-box feature-box-simple text-center">
                                <i class="icon-earphones-alt"></i>

                                <div class="feature-box-content">
                                    <h3>Customer Support<span>Need Assistence?</span></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="feature-box feature-box-simple text-center">
                                <i class="icon-credit-card"></i>

                                <div class="feature-box-content">
                                    <h3>secured payment <span>Safe & Fast</span></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapibus lacus. Lorem ipsum dolor sit amet.consectetur adipiscing elit. </p>
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                        </div><!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="feature-box feature-box-simple text-center">
                                <i class="icon-action-undo"></i>

                                <div class="feature-box-content">
                                    <h3>Returns <span>Easy & Free</span></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapibus lacus.</p>
                                </div><!-- End .feature-box-content -->
                            </div><!-- End .feature-box -->
                        </div><!-- End .col-md-4 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .info-section -->




        </main><!-- End .main -->

@endsection

@push('js')
    <script src="{{ asset('ajax/add_to_cart.js') }}"></script>
@endpush