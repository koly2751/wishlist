<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Size;
use App\Color;
use App\SubCategory;
use App\Brand;
use App\Media;
use App\Offer;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public  function __construct(){

        $this->middleware('auth:admin');

    }
    // public $image;
    public function index(Request $request)
    {
        
        // dd($request->session()->get('image'));

        $data['offers'] =Offer::where('type',2)->get();

        $data['products'] = Product::latest()->get();
       
        return view('back.product.index',$data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //sob kichu nia aslam.
        $colors = Color::all();
        $sizes = Size::all();
        $brands = Brand::all();
        $subcategories = SubCategory::all();
        return view('back.product.create',compact('colors','sizes','brands','subcategories'));
    }


     public function drop()
    {
        //
        return view('back.product.drop');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       //code for txt file
       // dd($request->category_id);
        $str = $request->input("bigdescription");


        $strr =$request->input("shortdescription");


      

        //data insertion main code for product


       //validation

        $validate = $request->validate(
            [
                'title' => 'required|min:1',
                'price' => 'required|min:1',
                'stock' => 'required',
                
                //'picture' => 'required | mimes:jpeg,jpg,png | max:1000'
            ]
        );

        $arr = new Product();
        $arr->title = $request->input("title");  
        $arr->price = $request->input("price");
        // $arr->selling_price = $request->input("selling_price");
        
       
        //$arr->description = $request->input("description");
        $arr->brand_id=$request->input("brand_id");
        $arr->stock = $request->input("stock");
        $arr->subcategory_id=$request->input("subcategory_id");
        $arr->type= $request->input("type");
        $arr->save();


        $insertId = $arr->id;
        //use model function for saving data in color table 
        //
        $arr->colors()->attach($request->color); //ekhane function call korlam jeta model a call korlam r eta attch function use kore pivot table a data insert korsi . jar jnno color_id ta color_product  table a save hocche.
        $arr->sizes()->attach($request->size);

        if ($request->session()->get('image')) { //akhne condition dilam je session a je image save kore raksi oita ke get korelam and pivot kore media id and product id save korlam media product table a.
           $arr->medias()->attach($request->session()->get('image'));

           $request->session()->forget('image');
        }
        

     //txt file insertion code
          Storage::put("files/$insertId.txt", $str);
          Storage::put("files/product_short_description/$insertId.txt", $strr);

        return redirect()->route('admin.products.index')->with('success','Successfully Inserted New Product!');


      //image file insertion code and store the image in a folder 
      

         // return redirect('adproducts');

     
     //status ta ami  create page a likihi nai eta kintu abar admin er index page a thik e show korbe and ata wok like as action.
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
    public function image($id)
    {

      // return $this->image=array(1,2,3);
    }



  
    public function imageee(Request $request)
    {

         $validate = $request->validate(
        [
            'file' => 'required',
        ]);


        //for saving multiple image
        $files=$request->file('file');
        
            foreach($files as $file){
                $media = new Media();
                $media->image = strtolower($file->getClientOriginalExtension());

                
                

            if ($media->save()) {

                $arr[]=$media->id; 
                $imagename = 'product-'.$media->id.'.'.$media->image;
                 if (File::exists('image_real/medias/product400'))
                    {
                       $product = Image::make($file)->resize(400,400)->save("image_real/medias/product400/$imagename");
                        
                    }else{
                        File::makeDirectory('image_real/medias/product400',0775,true);
                       $product = Image::make($file)->resize(400,400)->save("image_real/medias/product400/$imagename"); 
                    }


                    if (File::exists('image_real/medias/product800'))
                    {
                       $product = Image::make($file)->resize(800,800)->save("image_real/medias/product800/$imagename");
                        
                    }else{
                        File::makeDirectory('image_real/medias/product800',0775,true);
                       $product = Image::make($file)->resize(800,800)->save("image_real/medias/product800/$imagename"); 
                    }
//            resize image for category and upload
            
            

            //$file->move("backend/images/media", "media-$media->id.$media->image");
                    if (File::exists('image_real/medias/product800'))
                    {
                        $product800 = Image::make($file)->resize(800,800)->save("image_real/medias/product800/$imagename");
                        
                    }else{
                        File::makeDirectory('image_real/medias/product800',0775,true);
                       $product800 = Image::make($file)->resize(800,800)->save("image_real/medias/product800/$imagename");
                    }
            
//            resize image for category and upload
            
            
        }


            }

       Session::put('image',$arr);  //image ta ke session diye dore raklam //first er ta variable 2nd ta kon data ta ke rakhbo..
       
       return back()->with('success','Image inserted successfully'); 
     
       
    }

    
     public function imageedit(Request $request){
           // return $request->id;
        $files = $request->file('file');
         $file = $files->getClientOriginalExtension();
      // return response()->json($file, 200);
        //return $id->getClientOriginalExtension();
        $ext = strtolower($file);
        
        // //echo $ext;
        
        $media = Media::find($request->id);
         $old_ext = $media->image;
        if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif'){

            $media->image = $ext;
            if($media->save()){
                
                 $imagename = 'product-'.$media->id.'.'.$media->image;
                 if (File::exists('image_real/medias/product400'))
                    {
                       // unlink("image_real/medias/product400/product-$request->id.$old_ext");
                       $product = Image::make($files)->resize(400,400)->save("image_real/medias/product400/$imagename");
                        
                    }else{
                       //  unlink("image_real/medias/product400/product-$request->id.$old_ext");
                        File::makeDirectory('image_real/medias/product400',0775,true);
                       $product = Image::make($files)->resize(400,400)->save("image_real/medias/product400/$imagename"); 
                    }

                     if (File::exists('image_real/medias/product800'))
                    {
                       // unlink("image_real/medias/product800/product-$request->id.$old_ext");
                       $product = Image::make($files)->resize(800,800)->save("image_real/medias/product800/$imagename");
                        
                    }else{
                        // unlink("image_real/medias/product800/product-$request->id.$old_ext");
                        File::makeDirectory('image_real/medias/product800',0775,true);
                       $product = Image::make($files)->resize(800,800)->save("image_real/medias/product800/$imagename"); 
                    }


                return redirect()->back()->with('success', 'Image successfully updated !!');
            }
          return redirect()->back()->with('success', 'Image successfully not updated !!');     
        }
       
     }



    public function offerproduct(Request $request){
            //return $request->checkbox;
      foreach ($request->checkbox as $key => $value) {
         $hiya = Product::find($value);
         $hiya->offer = $request->offer;
         $hiya->save();
      }


         return back()->with('success','Offer added successfully on selected product'); 

     }




    public function edit($id)
    {

        $colors = Color::all();
        $sizes = Size::all();
        $brands = Brand::all();
        $subcategories = SubCategory::all();
        $product = Product::find($id);
       // return $product->medias;
        return view('back.product.edit',compact('product','colors','sizes','brands','subcategories'));



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
        
       $products = Product::find($id);
       $multiplied = ($products->colors)->map(function ($item, $key) {
            return $item->id;
        });
      // return $multiplied;
      //   die();
       $products->title = $request->title;
       $str = $request->input("description");

       $strr =$request->input("shortdescription");
      
       $products->price = $request->input("price");
        // $arr->selling_price = $request->input("selling_price");
        
       
        //$arr->description = $request->input("description");
        $products->brand_id=$request->input("brand_id");
        $products->stock = $request->input("stock");
        $products->subcategory_id=$request->input("subcategory_id");
        $products->type= $request->input("type");
         $products->colors()->detach($request->color);
        $products->sizes()->detach($request->size);
        $products->colors()->attach($request->color);
        $products->sizes()->attach($request->size);
        $products->save();

        if($str){
            Storage::put("files/$products->id.txt", $str);
        }


          if($strr){
              Storage::put("files/product_short_description/$products->id.txt", $strr);
          }
       
       return redirect()->route('admin.products.index');
         
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $media = $product->medias;
        //return $media;
        $id = $media->map(function ($item, $key) {
                        return $item->id;
                    });
          if(count($id)>0){
                if($product->medias()->detach($id)){
                    $pic = Media::find($id);
                    foreach ($pic as $key => $value) {
                       unlink("image_real/medias/product400/product-$value->id.$value->image");
                       unlink("image_real/medias/product800/product-$value->id.$value->image");
                       
                }
          }
          $color = $product->colors;
        //return $media;
        $colorid = $color->map(function ($item, $key) {
                        return $item->id;
                    });
        $product->colors()->detach($colorid);

        $size = $product->sizes;
        //return $media;
        $sizeid = $size->map(function ($item, $key) {
                        return $item->id;
                    });
        $product->sizes()->detach($sizeid);
          $product->delete();
          return redirect()->route('admin.products.index')->with('success','Successfully Deleted Item!');
    }
}

}
