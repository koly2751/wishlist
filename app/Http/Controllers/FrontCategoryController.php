<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\SubCategory;
use App\Brand;
class FrontCategoryController extends Controller
{
    public $data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response



     */



    public  function __construct()
    {
       $this->data['subcategories']=SubCategory::where('action', 1)->get()->groupBy('name');
       $this->data['categories']=Category::all();
    }



    public function index()
    {
        //category all page dta showing 
        $this->data['brands']=Brand::orderBy('name', 'DSC')->paginate(4)->where('action',1);
        $this->data['products']=Product::paginate(20);
        //$this->data['categories']=Category::all();
        $this->data['featureds']=Product::orderBy('title', 'DSC')->paginate(6);
        
        return view('front.category.categoryall',$this->data);
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


        //category indiviual page er data showing
        $this->data['subcat']=SubCategory::where('name',$id)->inRandomOrder()->first();  
        $this->data['categories']=Category::all();
        $this->data['cat'] = $id;
        $scat = SubCategory::select('id')->where('name', $id)->get();

           //return $scat;
           //$sid = $scat[0]->id;
          $this->data['cat_products'] = Product::whereIn('subcategory_id',$scat)->paginate(20); 
          $this->data['featureds']=Product::orderBy('title', 'DSC')->paginate(6);
           // $data['subcategories']=SubCategory::all()->groupBy('name');
          $this->data['brands']=Brand::all()->where('action',1);
       
         return view('front.category.categoryindi',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response

     */

     public function typee($id)

    {

        //catagory typee page er data showing
       $this->data['cath']=Category::find($id);
       $scat = SubCategory::select('id')->where('category_id', $id)->get();

       $this->data['cat_products'] = Product::whereIn('subcategory_id',$scat)->paginate(20); 
       $this->data['featureds']=Product::orderBy('title', 'DSC')->paginate(6);
       $this->data['brands']=Brand::all()->where('action',1);
       return view('front.category.categorytype', $this->data);
    }








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
