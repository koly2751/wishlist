<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SubCategory;
use App\Category;
use App\City;
use App\Shipping;
use App\Sale;
use App\ProductSale;
use Session;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public $data;

    public  function __construct()
    {
        $this->middleware('auth')->except('register', 'charge');
       $this->data['subcategories']=SubCategory::all()->groupBy('name');
       $this->data['categories']=Category::all();
    }


    public function index(Request $request)
    {
        //code for front view to get the check out
         $this->data['cities'] = City::all();

         if(Session::has('charge')){
            return view('front.checkout.checkout', $this->data);

         }

         return redirect()->route('cart.index');

         
    }
    public function charge(Request $request){
        $this->validate($request, [
                'charge' => 'required'
       ]);


        //return $request->charge;
         Session::put('charge',$request->charge);

         return response()->json($request->charge, 200);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
        // return view('front.checkout.checkoutregister', $this->data);
    }


    public function register(){
        //register form from visitors.

        return view('front.checkout.checkoutregister', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        //checkoutcontroller  storing the data

    $this->validate($request, [
                'name' => 'required|min:3',
                'phone' =>'required|min:9',
                'address' =>'required|min:9'
       ]);


        //dd(Auth::user()->id);

        $arr = new Shipping();
        $arr->name = $request->input("name");
        $arr->phone = $request->input("phone");
        $arr->address = $request->input("address");
        
        $sale = new Sale();
        if ($arr->save()) {

            if (Session::has('charge')) {
               // return 'im here';
            $sale->user_id =  Auth::user()->id;
            $sale->shipping_id = $arr->id;
            $sale->charge = Session::get('charge');
            $sale->date = date("Y-m-d H:i:s");
            $sale->status = '1';
              
            }
           

        if($sale->save()){

                $items = new ProductSale();
                if (Session::has('carts')) {


                    $ship = Session::get('carts');

                    foreach ($ship as $key => $value) {

                        $items->product_id =$key;
                        $items->sale_id = $sale->id;
                        $items->quantity =$value['qty'];
                        $items->wrapp_id =$value['wrp_id'];

                        $items->color_id  =$value['color'];
                        
                        $items->size_id  =$value['size'];  
                        if($items->save()){
                            $request->session()->forget('carts');
                            $request->session()->forget('charge');
                        }


                    }

                   

                }




              }  
        }

        return  back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
