
function add_to_cart(event, id){
	event.preventDefault();
	var qty = $('.qty-'+id).val();

   var color = $('input[name=pcolor]:checked').val();
   var size = $('input[name=size]:checked').val();
   var wrapping = $('input[name=wrapping]:checked').val();

   if (!wrapping) {
    swal("Oops!", "Please confirm your Wrapping!", "error");
   }
   else{



          $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
     });
      $.ajax({
         url: "/addtocart",
         method: 'post',
         data: {
            id: id,
            qty: qty,
            color: color,
            size: size,
            wrapping: wrapping
         },
         success: function(result){

           // alert(result);
           var kk = JSON.stringify(result);
           //let count = $('#cart-count').text();
           

           //$('#cart-count').text(qty);
            alert(kk);
            var count = 0;
            var total = 0;
            var text = "";
            var x;
            for (x in result) {
             
             count++;
             total += parseInt(result[x]['qty'])*parseInt(result[x]['price']);
             text += '<div class="product">';
             text += '<div class="product-details">';
             text += '<h4 class="product-title">';
             text += '<a href="product.html">' + result[x]['title'] + '</a>';
             text += '</h4><span class="cart-product-info">';
             text += '<span class="cart-product-qty">' + result[x]['qty'] + '</span> X ' + result[x]['price'];
             text += '</span></div>';


             text += '<figure class="product-image-container">';
             text += '<a href="product.html" class="product-image">';
             text += '<img src="'+ window.location.origin +'/image_real/medias/product400/product-'+ result[x]['mid'] + '.' + result[x]['media'] +'" alt="product">';
             text += '</a><button type="button" class="btn-remove" title="Remove Product" value="" onclick="deleteCart(event,' + x + ')"><i class="icon-cancel"></i></button>';
             text += '</figure>';

             text += '</div>';
               
            }

            $('#hiya-cart').html(''); 
            $('.hiya-cart').html(text);
            if(count){
                $('#cart-count').text(''); 
                $('.cart-count').text(count);   
            }

            if(total){
                $('#total-hiya').text(''); 
                $('.total-hiya').text(total);   
            }

           
             //alert(result['1']['title']);
         }
     });
   }

  // alert('Color: ' + color + 'Size: ' + size + 'wrapping: ' + wrapping);

  
	//alert(qty);

	

  
	
}
	


function deleteCart(event, id){
  event.preventDefault();
 



    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
     });
      $.ajax({
         url: "/deletecart",
         method: 'get',
         data: {
            id: id
         },
         success: function(result){

           // alert(result);
           var kk = JSON.stringify(result);
           //let count = $('#cart-count').text();
           

           //$('#cart-count').text(qty);
            alert(kk);
            var count = 0;
            var total = 0;
            var text = "";
            var x;
            for (x in result) {
             
             count++;
             total += parseInt(result[x]['qty'])*parseInt(result[x]['price']);
             text += '<div class="product">';
             text += '<div class="product-details">';
             text += '<h4 class="product-title">';
             text += '<a href="product.html">' + result[x]['title'] + '</a>';
             text += '</h4><span class="cart-product-info">';
             text += '<span class="cart-product-qty">' + result[x]['qty'] + '</span> X ' + result[x]['price'];
             text += '</span></div>';


             text += '<figure class="product-image-container">';
             text += '<a href="product.html" class="product-image">';
             text += '<img src="'+ window.location.origin +'/storage/medias/product400/product-'+ result[x]['mid'] + '.' + result[x]['media'] +'" alt="product">';
             text += '</a><button type="button" class="btn-remove" title="Remove Product" value="" onclick="deleteCart(event,' + x + ')"><i class="icon-cancel"></i></button>';
             text += '</figure>';

             text += '</div>';
               
            }

            $('#hiya-cart').html(''); 
            $('.hiya-cart').html(text);
            if(count >= 0){
                $('#cart-count').text(''); 
                $('.cart-count').text(count);   
            }

            if(total >= 0){
                $('#total-hiya').text(''); 
                $('.total-hiya').text(total);   
            }

            
            $('#gift-remove').text('');
            $('#wrapping-remove').text('');
            $('#hiya-charge').val('৳ 0.00');
            $('#shipcharge').text('৳ 0.00');
            $('#gift-total').text('৳ 0.00');
            $('#wrapp-total').text('৳ 0.00');
            $('#tax').text('৳ 0.00');
            $('#avisa').text('৳ 0.00');

           
             //alert(result['1']['title']);
         }
     });
   

  // alert('Color: ' + color + 'Size: ' + size + 'wrapping: ' + wrapping);

  
  //alert(qty);

  

  
  
}
  

