@extends('front.include.mapp')

@push('css')

<style type="text/css">
    .recipient_img a img {
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
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table-container">
                    <table class="table table-cart">
                        <thead>
                            <tr>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="gift-remove">
                            @php
                            $total = 0
                            @endphp
                            @if(Session()->has('carts'))

                            @foreach(Session::get('carts') as $key => $cart)
                            @php
                            $total += ($cart['qty']*$cart['price'])

                            @endphp
                            <tr class="product-row">
                                <td class="product-col">

                                    <figure class="product-image-container">
                                        <a href="#" class="product-image">
                                            <img src="{{asset('image_real/medias/product400/product-'.$cart['mid'].'.'.$cart['media']) }}" alt="product">                                      
                                     
                                        </a>
                                    </figure>

                                    <h2 class="product-title">
                                        <a href="product.html">{{ $cart['title'] }}</a>
                                    </h2>
                                </td>
                                <td>{{ $cart['price'] }}</td>
                                <td>
                                    <input class="vertical-quantity form-control" type="text" value="{{ $cart['qty'] }}">
                                </td>
                                <td>৳{{ ($cart['qty']*$cart['price']) }}</td>
                            </tr>
                            <tr class="product-action-row">
                                <td colspan="4" class="clearfix">
                                    <div class="float-left">
                                        <input type="radio" name="" value="{{ $key }}" id="hiya-checkbox">
                                    </div><!-- End .float-left -->

                                    <div class="float-right">
                                        <button type="button" class="btn-remove" title="Remove Product" value="{{ $key }}" onclick="deleteCart(event, {{ $key }})"></button>
                                    </div><!-- End .float-right -->
                                </td>
                            </tr>
                            @endforeach
                            @endif




                            <table class="table table-cart">
                                <thead>
                                    <tr>
                                        <th class="product-col">Wrapping</th>
                                        <th class="qty-col">Gift Name</th>
                                        <th class="price-col">Price</th>

                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id='wrapping-remove'>
                                    @php
                                    $totall = 0
                                    @endphp
                                    @if(Session()->has('carts'))

                                    @foreach(Session::get('carts') as $key => $cart)
                                    @php
                                    $totall += ($cart['wp_price'])

                                    @endphp
                                    <tr class="product-row">
                                        <td class="product-col">

                                            <figure class="product-image-container">
                                                <a href="#" class="product-image">
                                                    <img src="{{ asset('backend/images/wrapps/wrapp-'.$cart['wrp_id'].'.'.$cart['wp_image']) }}" alt="product">
                                                </a>
                                            </figure>
                                        </td>

                                        <td>
                                            {{$cart['title']}}
                                        </td>

                                        <td>{{ $cart['wp_price'] }}</td>

                                        <td>৳{{ ($cart['wp_price']) }}</td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="clearfix">
                                            <div class="float-left">
                                                <a href="{{ route('userproducts.index') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                                            </div><!-- End .float-left -->

                                            <div class="float-right">
                                                <a href="#" class="btn btn-outline-secondary btn-clear-cart">Clear Shopping Cart</a>
                                                <a href="#" class="btn btn-outline-secondary btn-update-cart">Update Shopping Cart</a>

                                            </div><!-- End .float-right -->
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                </div><!-- End .cart-table-container -->
                <!--                        whole wraping start-->
                <div class="product-single-tabs">
                    <div class="">
                        <h3>Want to wrap all the products in a single box? Choose a design from here! </h3>
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
                <!--                        whole wraping end-->

                <div class="cart-discount">
                    <h4>Apply Discount Code</h4>
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter discount code" required>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Apply Discount</button>
                            </div>
                        </div><!-- End .input-group -->
                    </form>
                </div><!-- End .cart-discount -->
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">

                        @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                        @endif
                    <h3>Summary</h3>

                    <h4>
                        <a href="#total-estimate-section">Estimate Shipping and Tax</a>
                    </h4>
                 <table class="table table-totals">
                        <tbody>

                              <form action="#">
                            <!-- End .form-group -->

                            <div class="form-group form-group-sm">
                                <label>City</label>
                                <div class="select-custom">
                                    <select class="form-control form-control-sm select">
                                        <option value="0">Choose your City</option>
                                        @foreach($cities as $citi)
                                        <option value="{{$citi->charge}}">{{ $citi->name}}</option>
                                        @endforeach
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .form-group -->

                            

                        </form>

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
                                <td>Shipping Charge</td>
                                <td id="shipcharge">৳ 

                                        @if(Session()->has('charge'))
                                            {{Session::get('charge')}}
                                        @else

                                            00
                                        @endif
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Order Total</td>
                                <td id="avisa" class="avisa">৳ {{ $total+$totall }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods">
                       
                        <a href="{{ route('checkoutregister.index') }}" class="btn btn-block btn-sm btn-primary">Go to Checkout</a>
                        <a href="#" class="btn btn-link btn-block">Check Out with Multiple Addresses</a>
                    </div><!-- End .checkout-methods -->
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main>

@endsection

@push('js')
<script src="{{ asset('ajax/add_to_cart.js') }}"></script>
<script>
    $('.select').on('change', function(e) {
        var charge = $(this).find(':selected').val();

        $('#hiya-charge').val('৳ ' + charge);
        $('#shipcharge').text('৳ ' + charge);

        var total = <?php echo $total+$totall; ?>;
        alert(total);
        $('#sp-charge').val(charge);
        $('.avisa').text('৳ ' + (parseInt(total) + parseFloat(charge)));



    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
     });
      $.ajax({
         url: "/charge",
         method: 'get',
         data: {
            charge: charge
         },
         success: function(result){

            console.log(result);
         }
     });
        


    });

</script>

@endpush
