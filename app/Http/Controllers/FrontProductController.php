<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Product;
use App\Color;
use App\Size;
use App\Wrapp;
use App\SubCategory;
use App\Category;
use Cookie;
use App\Brand;
use App\Offer;
use App\Review;


class FrontProductController extends Controller
{

    public $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



      public  function __construct()
    {
       // $this->middleware('auth', ['except' => ['index', 'create', 'offer', 'alloffer']]);
       $this->data['subcategories']=SubCategory::all()->groupBy('name');
       $this->data['categories']=Category::all();
    }


    public function index()
    {


       //All gift list/all product page data showing
         $this->data['products']=Product::paginate(20);
         $this->data['featureds']=Product::orderBy('title', 'DSC')->paginate(6);
         $this->data['brands']=Brand::all()->where('action',1);
         return view('front.product.product',$this->data);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {


         
         // $this->data['type'] = $type;
    
    //personalised product er data showing page

         $this->data['categories']=Category::all(); 
         $this->data['brands']=Brand::all()->where('action',1);
         $this->data['oproducts']=Product::where('type', 2)->get();
         $this->data['featureds']=Product::orderBy('title', 'DSC')->paginate(6);
        
    //return $this->data;
      return view('front.product.personalised',$this->data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    public function offer($offer){


        //offer page ...er offer related product showing page/single offer page..
        //return $offer;
        
          $offer = Offer::where('type', 2)->get()->map(function ($items, $key){
            return $items->id;
        });
        $this->data['offers']=Offer::all();
        $this->data['brands']=Brand::all()->where('action',1);
        $this->data['featureds']=Product::orderBy('title', 'DSC')->paginate(6);
     $this->data['offer_ps'] =Product::where('offer',$offer)->get();
      $this->data['offersingle']=Offer::where('id', $offer)->first();
        return view('front.product.offer-product',$this->data);
    }


    public function alloffer(){


        //  $id = explode('-',$id);
        // $id = $id[count($id)-1];
        //all offer elated product page data showing page
         $offer = Offer::where('type', 2)->get()->map(function ($items, $key){
            return $items->id;
        });
         $this->data['brands']=Brand::all()->where('action',1);
       $this->data['products']=Product::whereIn('offer', $offer)->paginate(40);
        $this->data['featureds']=Product::orderBy('title', 'DSC')->paginate(6);
        $this->data['offer_products'] =Offer::where('type','2')->first();
        return view('front.product.alloffer',$this->data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   



        $id = explode('-',$id);
        $id = $id[count($id)-1];

        $this->data['reviews']= Review::where('product_id', $id)->latest()->take(5)->get();
      //single product page..
        $this->data['wrapps']=Wrapp::all();
        $this->data['products']=Product::find($id);
 
        $ppopo = $this->data['products']->subcategory['id'];
        $zia = $this->data['products']->brand->id;
        $this->data['rproducts'] =Product::where('subcategory_id',$ppopo)
                                     ->orWhere('brand_id',$zia)->take(7)->get();

        $this->data['featureds']=Product::orderBy('title', 'DSC')->paginate(6);
                                     

        

       //  Cookie::queue(
            
       //      // $arr['subcategory'] = $products->$subcategory->name;
       //      // $arr['brand']=$products->$brand->name;
       //   Cookie::forever('pio', json_encode($arr))
       // );
       
        return view('front.product.single-product',$this->data);
       
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