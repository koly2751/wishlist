<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Wish List</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Wish List">
    <meta name="author" content="SW-THEMES">
    <meta name="_token" content="{{csrf_token()}}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('front/assets/images/icons/favicon.ico')}}">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">



    @stack('css')
    <script src="{{asset('front/assets/js/jquery.min.js')}}"></script>
</head>

<body>
    <div class="page-wrapper">

        @include('front.include.header')
        <!-- End .header -->

         @include('front.include.flash_message')
        @yield('content')
        @include('front.include.footer')

        <!-- End .footer -->
    </div><!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active"><a href="{{route('home')}}">Home</a></li>
                    <li>
                        <a href="{{route('usercategories.index')}}">Categories</a>
                       <ul>
                            @yield('recipent')
                           
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('userproducts.index')}}">All Gift List</a>
                    </li>

                    <li>
                        <a href="{{route('userproducts.index')}}">Occasion</a>
                        <ul>
                            
                             @yield('subcategorymenu')

                        </ul>
                    </li>
                    <li>
                        <a href="#">Pages<span class="tip tip-hot">Hot!</span></a>
                        <ul>
                            <li><a href="{{ route('cart.index') }}">Shopping Cart</a></li>
                            <li>
                                <a href="{{route('checkoutregister.index')}}">Checkout</a>
                               
                            </li>
                            <li><a href="{{route('about')}}">About</a></li>
                            <li><a href="{{route('login')}}" class="login-link">Login</a></li>
                            <li><a href="{{ route('password.request') }}">Forgot Password</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="{{route('alloffer')}}">Special Offer!<span class="tip tip-hot">Hot!</span></a></li>
                    
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
                <a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    
    @include('front.include.adver')



    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->

    <script src="{{asset('front/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('front/assets/js/plugins.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('front/assets/js/main.min.js')}}"></script>


    @stack('js')
    <script src="{{ asset('ajax/search.js') }}"></script>
</body>

</html>
