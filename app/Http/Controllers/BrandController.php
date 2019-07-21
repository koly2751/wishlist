<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function __construct(){

        $this->middleware('auth:admin');

    }
    public function index()
    {
        //

        $data['brands'] = Brand::all();
       
        return view('back.brand.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('back.brand.create');
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

         

          //code for logo image of brand
          $file = $request->file('logo');
        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = "";
            }
        } else {
            $ext = "";
        }


        // validation code 
        $validate = $request->validate(
            [
                'name' => 'required|min:1',
                
                //'picture' => 'required | mimes:jpeg,jpg,png | max:1000'
            ]
        );


            //code for banner image of brand

           $filee = $request->file('banner');
           
        if ($filee) {
            $extt = strtolower($filee->getClientOriginalExtension());

            if ($extt != "jpg" && $extt != "png" && $extt != "gif" && $extt != "jpeg") {
                $extt = "";
            }
        } else {
            $extt = "";
        }







        //insert code for brand 
        //start of data insert

        $arr = new Brand();
        $arr->name = $request->input("name");
        $arr->logo = $ext;
        $arr->banner = $extt;
        $arr->action = $request->input("action");
        $arr->save();
        $insertId = $arr->id;

        //code for image upload/insert extension indata base and image into another folder

        if ($ext) {
            $file->move("backend/images/brands", "brand-$insertId.$ext");
        }

         if ($extt) {
            $filee->move("backend/images/brands/banner", "brand_banner-$insertId.$ext");
        }


        return redirect()->route('admin.brands.index')->with('success','Successfully Inserted!');



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

        //code for edit the brand 
        $brand = Brand::find($id);
        return view('back.brand.edit',compact('brand'));
        
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



        //code for update the code for the brand

        $file = $request->file('logo');
        $filee= $request->file('banner');

        $brand = Brand::find($id);
       
     

       

        //update code for logo image
           
        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = $brand->logo;
            }
        } else {
            $ext = $brand->logo;
        }


        //update code for banner image
        if ($filee) {
            $extt = strtolower($filee->getClientOriginalExtension());

            if ($extt != "jpg" && $extt != "png" && $extt != "gif" && $extt != "jpeg") {
                $extt = $brand->banner;
            }
        } else {
            $extt = $brand->banner;
        }



        //update code for other field

        $brand->name = $request->name;
        $brand->logo = $ext;
        $brand->banner = $extt;
        
        $brand->action = $request->action;
    
 

        $id = $brand->id;
        

        
        //update code for brand image and banner image
     if ($brand->save()) {

            // portion for update logo image and unlik it and update at same place
            if(file_exists("backend/images/brands/brand-$id")){
                
                 unlink("backend/images/brands/brand-$id");
            }
             
             if($file){
                
                 $file->move("backend/images/brands", "brand-$id.$ext");
             }


             //portion for unlink banner image and update at same place

         if(file_exists("backend/images/brands/banner/brand_banner-$id")){
                
                 unlink("backend/images/brands/banner/brand_banner-$id");
            }
           
           if ($filee) {
               # code...
             $filee->move("backend/images/brands/banner", "brand_banner-$id.$extt");
           }
           
           
        }
        
        return redirect()->route('admin.brands.index')->with('success','Successfully Updated!');

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
        //code for delete the item of brand

        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('admin.brands.index')
                        ->with('success','Item deleted successfully');
    }




//this portion is a function of active code
      public function activate($id){
        Brand::where('id',$id)->update(['action'=>1]);
        return redirect()->route('admin.brands.index');
    }

    //this portion for deactive function
    public function deactivate($id){
        Brand::where('id',$id)->update(['action'=>0]);
        return redirect()->route('admin.brands.index');
    }
}
