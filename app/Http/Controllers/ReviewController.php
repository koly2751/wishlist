<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\SubCategory;
use App\Category;
use App\Review;

class ReviewController extends Controller
{
    //

   public $data;

    public  function __construct()
    {
       $this->middleware('auth');
       $this->data['subcategories']=SubCategory::all()->groupBy('name');
       $this->data['categories']=Category::all();
    }








    public function review(Request $request)
    {
        
    	// return Auth::auth($request);
       

    $this->validate($request, [
        
                'review' =>'required',
                 'star' =>'required'
       ]);


        $arr = new Review();
        
        $arr->description = $request->input("review");
        $arr->star = $request->input("star");
        $arr->user_id =  Auth::user()->id;
        $arr->product_id =$request->user;
        if($arr->save()){

        	 return redirect()->back()->with('success','Thanks for your valuable comment!');
        }
        else{

        	return redirect()->back()->with('warning','Something is wrong');
        }
       

       
    //     if () {

    //         if (Session::has('charge')) {


    //         $sale = new Sale();
    //         $sale->user_id =  Auth::user()->id;
    //         $sale->shipping_id = $arr->id;
    //         $sale->charge = Session::get('charge');
    //         $sale->date = date("Y-m-d H:i:s");
    //         $sale->status = 'pending';
              
    //         }
           

    //     if($sale->save()){

    //             $items = new ProductSale();
    //             if (Session::has('carts')) {


    //                 $ship = Session::get('carts');

    //                 foreach ($ship as $key => $value) {

    //                     $items->product_id =$key;
    //                     $items->sale_id = $sale->id;
    //                     $items->quantity =$value['qty'];
    //                     $items->wrapp_id =$value['wrp_id'];
    //                     $items->color_id  =$value['color'];
    //                     $items->size_id  =$value['size'];  
    //                     if($items->save()){
    //                         $request->session()->forget('carts');
    //                         $request->session()->forget('charge');
    //                     }


    //                 }

                   

    //             }




    //           }  
    //     };






    //     return  $request->next();







    // }




}
}
