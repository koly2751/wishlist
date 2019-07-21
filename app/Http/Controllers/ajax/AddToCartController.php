<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Media;
use App\Wrapp;
use Illuminate\Support\Facades\Session;

class AddToCartController extends Controller
{
    //

    public function addcart(Request $request){

     // return $request->all();
    	//request diye id ta nilam productid jeta ajax diye pass korsi .
    	$products =Product::find($request->id);
      $wrapp =Wrapp::find($request->wrapping);
    	$medias=$products->medias; //pivot table er jnno eta korlam pivot always pivot table er jnno alada kore data session a rakhar dorkar nai. aktable a diyei hbe

        if(Session::has('carts')){
            $carts=Session::get('carts');
            if (array_key_exists($request->id, $carts))
              {
                $carts["$products->id"]['qty'] = $request->qty;
              }
              else
              {
                $cart['title'] = $products->title;
                $cart['price'] = $products->price;
                $cart['mid'] = $medias[0]->id;
                $cart['media'] = $medias[0]->image;
                $cart['wp_price'] = $wrapp->price;
                $cart['wrp_id'] = $wrapp->id;
                $cart['wp_image'] = $wrapp->image;
                $cart['qty'] = $request->qty;
                $cart['color'] = $request->color;
                $cart['size'] = $request->size;               
                $carts["$products->id"] = $cart;
              }
        }
        else
          {
            $cart['title'] = $products->title;
            $cart['price'] = $products->price;
            $cart['mid'] = $medias[0]->id;
            $cart['media'] = $medias[0]->image;
            $cart['wp_price'] = $wrapp->price;
            $cart['wrp_id'] = $wrapp->id;
            $cart['wp_image'] = $wrapp->image;
            $cart['qty'] = $request->qty;
            $cart['color'] = $request->color;
            $cart['size'] = $request->size;         
            $carts["$products->id"] = $cart;
          }
        
    	//Session::put('products',$products);
    	Session::put('carts',$carts);

       
    	return response()->json($carts, 200);
    }

    public function deleteCart(Request $request){
        //return $request->all();

        if(Session::has('carts')){
            $carts=Session::get('carts');
            if (array_key_exists($request->id, $carts))
              {
                //return 'ok';
                unset($carts["$request->id"]);
              }
        }
        Session::put('carts',$carts);
        return response()->json($carts, 200);
    }
}
