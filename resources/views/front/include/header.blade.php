<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left header-dropdowns">
                <!-- End .header-dropown -->

                <!-- End .header-dropown -->

                <div class="dropdown compare-dropdown">
                    <a href="{{route('home')}}" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        Welcome to Wishlist
                    </a>
                    <!-- End .dropdown-menu -->
                </div><!-- End .dropdown -->
            </div><!-- End .header-left -->

            <div class="header-right">
              <div class="header-dropdown dropdown-expanded">
                    <a href="#">User</a>
                    <div class="header-menu" style="background-color:#e31e27;">
                        <ul>
                            @guest                          
                            <li><a href="{{route('login')}}">LOG IN</a></li>
                            <li><a href="{{route('register')}}">Sign up</a></li>
                             @else
                              <li><a href="#">MY ACCOUNT </a></li>
                            <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }} 
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endguest
                            <li><a href="{{route('about')}}">About US</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->

            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <a href="{{route('home')}}" class="logo">
                    <img src="{{ asset('front/image/logo.png')}}" alt="Porto Logo">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                    <form action="{{ route('search') }}" method="get">
                        @csrf
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control search" name="something" id="search"  placeholder="Search..." required>
                            <!-- <div class="select-custom">
                                <select id="cat" name="cat">
                                    <option value="">All Categories</option>
                                    <option value="4">Fashion</option>
                                    <option value="12">- Women</option>
                                    <option value="13">- Men</option>
                                    <option value="66">- Jewellery</option>
                                    <option value="67">- Kids Fashion</option>
                                    <option value="5">Electronics</option>
                                    <option value="21">- Smart TVs</option>
                                    <option value="22">- Cameras</option>
                                    <option value="63">- Games</option>
                                    <option value="7">Home &amp; Garden</option>
                                    <option value="11">Motors</option>
                                    <option value="31">- Cars and Trucks</option>
                                    <option value="32">- Motorcycles &amp; Powersports</option>
                                    <option value="33">- Parts &amp; Accessories</option>
                                    <option value="34">- Boats</option>
                                    <option value="57">- Auto Tools &amp; Supplies</option>
                                </select>
                            </div> --><!-- End .select-custom -->
                            <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div><!-- End .headeer-center -->

            <div class="header-right">
                <button class="mobile-menu-toggler" type="button">
                    <i class="icon-menu"></i>
                </button>
                <div class="header-contact">
                    <span>Call us now</span>
                    <a href="tel:#"><strong>+8801789098767</strong></a>
                </div><!-- End .header-contact -->

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">



                        <span class="cart-count" id="cart-count">{{ Session()->has('carts')?count(Session()->get('carts')):0 }}</span>





                    </a>

                    <div class="dropdown-menu">
                        <div class="dropdownmenu-wrapper">
                            <div class="dropdown-cart-products hiya-cart" id="hiya-cart">
                                <!--{{ Session::get('products') }}-->
                                @php
                                $total = 0
                                @endphp
                                @if(Session()->has('carts'))

                                @foreach(Session::get('carts') as $key=>$cart)
                                @php
                                $total += ($cart['qty']*$cart['price'])

                                @endphp
                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="#">{{ $cart['title'] }}</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">{{ $cart['qty'] }}</span>
                                            x {{ $cart['price'] }}
                                        </span>
                                    </div><!-- End .product-details -->
                                    <!--pivot table medias thke image load koranor jnno products thke media diye image load korlam-->


                                    <figure class="product-image-container">
                                        <a href="#" class="product-image">
                                            <img src="{{asset('image_real/medias/product400/product-'.$cart['mid'].'.'.$cart['media']) }}" alt="product">


                                        </a>
                                     <button type="button" class="btn-remove" title="Remove Product" value="{{ $key }}" onclick="deleteCart(event, {{$key}})"><i class="icon-cancel"></i></button>
                                    </figure>


                                </div><!-- End .product -->

                                @endforeach
                                @endif

                                <!-- End .product -->
                            </div><!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>Total</span>

                                <span class="cart-total-price total-hiya" id="total-hiya">৳{{ $total }}</span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="{{ route('cart.index') }}" class="btn">View Cart</a>
                                <a href="{{ route('checkoutregister.index') }}" class="btn">Checkout</a>
                            </div><!-- End .dropdown-cart-total -->
                        </div><!-- End .dropdownmenu-wrapper -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li><a href="{{route('home')}}">Home</a></li>



                    <li>
                        <a href="{{route('usercategories.index')}}" class="sf-with-ul">Categories</a>

                        <ul>
                            @yield('recipent')
                           
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('userproducts.index')}}">All Gift List</a>

                    </li>
                    <li>
                        <a href="#" class="sf-with-ul">Ocassion</a>

                        <ul>
                            
                             @yield('subcategorymenu')

                        </ul>
                    </li>
                    

                    </li>
                    <li class="float-right"><a href="{{route('alloffer')}}">Special Offer!</a></li>
                </ul>
            </nav>
        </div><!-- End .header-bottom -->
    </div><!-- End .header-bottom -->
</header>
