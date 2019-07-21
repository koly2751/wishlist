$(document).ready(function() {

$("#search").keyup(function(){

	var something = $(this).val(); 
	$.ajax({

         url: "/search",
         method: 'get',
         data: {
            something: something
         },
         success: function(result){

         console.log(JSON.stringify(result));
         }
     });

});



});