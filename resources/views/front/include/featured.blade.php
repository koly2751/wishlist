<div class="featured-products-section carousel-section">
    <div class="container">
        <h2 class="h3 title mb-4 text-center">Featured Products</h2>
        <div class="featured-products owl-carousel owl-theme">
            @foreach($featureds as $featured)
            <div class="product">
                @foreach($featured->medias as $media)
                <figure class="product-image-container">
                    <a href="{{ route('userproducts.show',str_slug("$featured->title $featured->id"))}}" class="product-image">
                        <img src='{{ asset("/image_real/medias/product400/product-$media->id.$media->image")}}' alt="product">
                    </figure>
                    @break
                    @endforeach
                    <div class="product-details">
                         @php 
                            $star=0;
                       if($product->reviews->count() > 0){
                                $star = round($product->reviews->sum('star')/$product->reviews->count(), 1)*(100/5);}
                                @endphp
                                <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{$star}}%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div>
                        <!-- End .product-container -->
                        <h2 class="product-title">
                        <a href="{{ route('userproducts.show',str_slug("$featured->title $featured->id"))}}">{{$featured->title}}</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">৳{{$featured->price}}</span>
                            </div><!-- End .price-box -->
                            <div class="product-action">
                                <a href="{{route('userproducts.show',str_slug("$featured->title $featured->id"))}}" class="paction add-cart" title="Add to Cart">
                                    <span>View Cart</span>
                                </a>
                                </div><!-- End .product-action -->
                                </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endforeach
                                <!-- End .product -->
                                </div><!-- End .featured-proucts -->
                                </div><!-- End .container -->
                            </div>