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
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="col-lg-8">
                <ul class="checkout-steps">
                    <li>
                        <h2 class="step-title">Shipping Address</h2>
                        <form action="{{ route('checkoutregister.store') }}" method="POST">
                            @csrf

                            <div class="form-group required-field">
                                <label>Name </label>
                                <input type="text" class="form-control" name="name" required>
                            </div><!-- End .form-group -->

                        

                            <div class="form-group required-field">
                                <label class="">Phone Number </label>
                                <div class="form-control-tooltip">
                                    <input type="tel" class="form-control" name="phone" required>
                                    <span class="input-tooltip" data-toggle="tooltip" title="For delivery questions." data-placement="right"><i class="icon-question-circle"></i></span>
                                </div><!-- End .form-control-tooltip -->
                            </div><!-- End .form-group -->


                                <div class="form-group required-field">
                                <label>Address </label>
                                <input type="text" class="form-control" name="address" required>

                            </div><!-- End .form-group -->

                            <button class="btn btn-warning">Place Order</button>
                        </form>
                    </li>


                </ul>
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="order-summary">
                    <h3>Summary</h3>                       
                    <h4>
                        <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section">products in Cart</a>
                    </h4>

                    <div class="collapse" id="order-cart-section">
                        <table class="table table-mini-cart">
                            <tbody>

                                @php
                                $total = 0
                                @endphp
                                @if(Session()->has('carts'))

                                @foreach(Session::get('carts') as $key => $cart)
                                @php
                                $total += ($cart['qty']*$cart['price'])

                                @endphp
                                <tr>
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{ asset('image_real/medias/product400/product-'.$cart['mid'].'.'.$cart['media']) }}" alt="product">
                                            </a>
                                        </figure>
                                        <div>
                                            <h2 class="product-title">
                                                <a href="product.html">{{ $cart['title'] }}</a>
                                            </h2>

                                            <span class="product-qty">{{ $cart['qty'] }}</span>




                                        </div>

                                    </td>
                                    <td class="price-col"> ৳{{ $cart['price'] }}</td>

                                </tr>
                                @endforeach
                                @endif




                                @php
                                $totall = 0
                                @endphp
                                @if(Session()->has('carts'))

                                @foreach(Session::get('carts') as $key => $cart)
                                @php
                                $totall += ($cart['wp_price'])

                                @endphp
                                <tr>
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{ asset('backend/images/wrapps/wrapp-'.$cart['wrp_id'].'.'.$cart['wp_image']) }}" alt="product">
                                            </a>
                                        </figure>
                                        <div>
                                            <h2 class="product-title">
                                                <a>Wrapping</a>
                                            </h2>

                                        </div>

                                    </td>
                                    <td class="price-col"> ৳ {{ ($cart['wp_price']) }}</td>

                                </tr>

                                @endforeach
                                @endif



                            </tbody>
                        </table>
                            @php
                                $gtotal = $total+$totall
                            @endphp
                        <button class="btn btn-info">Total</button> <span class="float-right"><button class="btn btn-info" style="cursor: default;">৳ {{ $gtotal }}</button></span>
                    </div>


                          <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td> Gift Subtotal</td>
                                <td id="gift-total">৳ {{ $total }}</td>
                            </tr>

                            <tr>
                                <td> Wrapping Subtotal</td>
                                <td id="wrapp-total">৳ {{ $totall }}</td>
                            </tr>

                            <tr>
                                <td>Tax</td>
                                <td id="tax">৳ 0.00</td>
                            </tr>

                            <tr>
                                @if(Session()->has('charge'))

                                 @php

                                 $charge = Session()->get('charge');
                                 $gtotal += $charge
                                @endphp
                                <td>Shipping Charge</td>
                                
                                <td id="shipcharge">৳ {{$charge}}</td>
                             
                                @endif
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Order Total</td>

                                <td id="avisa" class="avisa">৳ {{ $gtotal }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- End #order-cart-section -->
                </div><!-- End .order-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->

    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main>


@endsection
