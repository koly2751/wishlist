<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

class SearchController extends Controller
{

	public $data;

	  public  function __construct()
    {
       $this->data['subcategories']=SubCategory::all()->groupBy('name');
       $this->data['categories']=Category::all();
    }

   public function search(Request $request){
	$something = $request->something;
    $this->data['products'] = Product::where('title','LIKE','%'.$something.'%')
   						->orWhere('price', 'LIKE', '%'.$something.'%')
   						->get();
     // return response()->json($products, 200);

   	$this->data['search_value'] = $something;
         $this->data['featureds']=Product::orderBy('title', 'DSC')->paginate(6);
         $this->data['brands']=Brand::all()->where('action',1);


   	return view('front.search.search', $this->data);
    }
}
