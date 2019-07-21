<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\SubCategory;
use App\Brand;

class FrontBrandController extends Controller
{
    //

     public $data;

	 public  function __construct()
    {
       $this->data['subcategories']=SubCategory::all()->groupBy('name');
       $this->data['categories']=Category::all();
    }


     public function brand(Request $request,$name)

    {
        //brand individual page data showing.   
    	  $this->data['bannerbrand'] =Brand::where('name',$name)->first();
        $this->data['brands']=Brand::orderBy('name', 'DSC')->paginate(4);
        $this->data['products']=Product::paginate(20);
        $this->data['categories']=Category::all();
        $this->data['featureds']=Product::orderBy('title', 'DSC')->paginate(6);


       	$bnd = Brand::select('id')->where('name', $name)->first();

           //return $scat;
           //$sid = $scat[0]->id;
        $this->data['brand_products'] = Product::whereIn('brand_id',$bnd)->paginate(20);
        
        return view('front.brand.brandindi',$this->data);
    }



}
