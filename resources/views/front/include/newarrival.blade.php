<div class="category_heading">
    <div class="container">
        <div class="row border_buttom p-0">
            <div class="col-lg-2">
                <h2 class="h3 mb-4 title text-left">New Arrivals</h2>
            </div>
            <div class="col-lg-8"></div>
            <div class="col-lg-2 text-right"><span><a href="{{route('userproducts.index')}}" style="text-decoration: none; color:#E31E27;font-weight:600; ">View more</a></span></div>
        </div>

    </div>
</div>

<div class="carousel-section">
    <div class="container">

        <div class="new-products owl-carousel owl-theme">

            @foreach($newarrivals as $new)
            <div class="product">
                @foreach($new->medias as $media)
                <figure class="product-image-container">
                    <a href="{{ route('userproducts.show',str_slug("$new->title $new->id"))}}" class="product-image">
                        <img src="{{ asset("/image_real/medias/product400/product-$media->id.$media->image")}}" alt="product">
                    </a>

                </figure>

                @break
                @endforeach
                <div class="product-details">
                     @php 
                     $star=0;
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
                        <a href="{{ route('userproducts.show',str_slug("$new->title $new->id"))}}">{{ $new->title }}</a>
                    </h2>
                    <div class="price-box">
                        <span class="product-price">৳{{ $new->price }}</span>
                    </div><!-- End .price-box -->

                    <div class="product-action">


                        <input type="hidden" class="qty-{{ $new->id }}" value="1">
                        <a href="{{ route('userproducts.show',str_slug("$new->title $new->id"))}}" class="paction add-cart" title="Add to Cart">
                            View Item
                        </a>


                    </div><!-- End .product-action -->
                </div><!-- End .product-details -->
            </div>

            @endforeach
            <!-- End .product -->

            <!-- End .product -->
        </div><!-- End .news-proucts -->
    </div><!-- End .container -->
</div>
