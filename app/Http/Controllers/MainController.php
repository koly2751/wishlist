<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Media;
use App\Product;
use App\SubCategory;
use App\Offer;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Cookie;

class MainController extends Controller
{
     // public $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    //   public  function __construct()
    // {
    //    $this->data['subcategories']=SubCategory::all()->groupBy('name');
    //    $this->data['categories']=Category::all();
    // }



    public function index()
    {
      //Cookie::forget('pio');


      // Cookie::queue(
      //  Cookie::forget('pio')
      // );

        // if ($type!='newarrival' && $type!='recommanded') {

        //      return  redirect('/');
           
        // }
        
        //Session::flush();

        // $data['type'] = $type;
        $data['categories']=Category::all();
        //dd($data['categories']);

        $data['brands']=Brand::all()->where('action', 1);
        // $data['medias']=Media::all();
        $data['subcategories']=SubCategory::all()->groupBy('name');
        $data['products']=Product::with(['medias','reviews'])->inRandomOrder()->paginate(12);
        // if(Session::has('carts')){
        //     dd(Session::get('carts'));
        // }
        $hiya = json_decode(Cookie::get('pio'));
        //dd($hiya[0]);




       

            //dd($type);
            $data['newarrivals']=Product::with(['medias','reviews'])->latest()->paginate(6);
            $data['featureds']=Product::with(['medias','reviews'])->orderBy('title', 'DSC')->get()->take(10);     

 
            $data['sliders'] = Offer::where('type',1)->get();
            $data['offers'] = Offer::where('type',2)->get();
            $data['promotions'] = Offer::where('type',4)->get();
        return view('front.main',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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


      public function myNotification($type)
    {
        switch ($type) {
            case 'message':
                alert()->message('Sweet Alert with message.');
                break;
            case 'basic':
                alert()->basic('Sweet Alert with basic.','Basic');
                break;
            case 'info':
                alert()->info('Sweet Alert with info.');
                break;
            case 'success':
                alert()->success('Sweet Alert with success.','Welcome to ItSolutionStuff.com')->autoclose(3500);
                break;
            case 'error':
                alert()->error('Sweet Alert with error.');
                break;
            case 'warning':
                alert()->warning('Sweet Alert with warning.');
                break;
            default:
                # code...
                break;
        }


        return view('my-notification');
    }



    public function about(){

        $data['categories']=Category::all();
        $data['subcategories']=SubCategory::all()->groupBy('name');

     // return  $this->data['abouts'] =Offer::all()->where('type',5);
       $data['abouts'] = Offer::where('type',5)->first();
        return view('front.aboutus.index',$data);
    }
}
