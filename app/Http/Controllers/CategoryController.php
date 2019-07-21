<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
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
         $data['allCategories'] = Category::all();
       
        return view('back.category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('back.category.create');
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

        //category sotre data into dtabase code/insert code

        $file = $request->file('image');
        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = "";
            }
        } else {
            $ext = "";
        }


        //validation

        $validate = $request->validate(
            [
                'name' => 'required|min:3',
                
               
            ]
        );



           $filee = $request->file('banner');
           
        if ($filee) {
            $extt = strtolower($filee->getClientOriginalExtension());

            if ($extt != "jpg" && $extt != "png" && $extt != "gif" && $extt != "jpeg") {
                $extt = "";
            }
        } else {
            $extt = "";
        }



        // dd($request->all());
        $arr = new Category();
        $arr->name = $request->input("name");
        $arr->image = $ext;
        $arr->banner = $extt;

       // $arr->type=$request->input("type");
        $arr->action = $request->input("action");
        $arr->save();
        $insertId = $arr->id;

         if ($ext) {
            $file->move("backend/images/categories", "category-$insertId.$ext");
        }

         if ($extt) {
            $filee->move("backend/images/categories/banner", "category_banner-$insertId.$ext");
        }

        return redirect()->route('admin.categories.index')->with('success','Successfully Inserted!');
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
        //category edit view

         $category = Category::find($id);
       
        

        return view('back.category.edit',compact('category'));
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


        //category update code

        $file = $request->file('image');
        $filee= $request->file('banner');

        $category = Category::find($id);
       
     

       


           
        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = $category->image;
            }
        } else {
            $ext = $category->image;
        }




        if ($filee) {
            $extt = strtolower($filee->getClientOriginalExtension());

            if ($extt != "jpg" && $extt != "png" && $extt != "gif" && $extt != "jpeg") {
                $extt = "";
            }
        } else {
            $extt = "";
        }




        $category->name = $request->name;
        //$category->type=$request->type;
        
        $category->action = $request->action;
    
 

        $id = $category->id;
        

        //fist a cheeck korlam je $categorysave hbe tokhn jodi file exsit kore oi folder a
        //tahole unlink korbe and notun pic link kore dibe.
      
   if ($category->save()) {

            if(file_exists("backend/images/categories/category-$id")){
                
                 unlink("backend/images/categories/category-$id");
            }
           
           if ($file) {
               # code...
             $file->move("backend/images/categories", "category-$id.$ext");
           }


             if(file_exists("backend/images/categories/banner/category_banner-$id")){
                
                 unlink("backend/images/categories/banner/category_banner-$id");
            }
           
           if ($filee) {
               # code...
             $filee->move("backend/images/categories/banner", "category_banner-$id.$ext");
           }
           
        }
        
        
        return redirect()->route('admin.categories.index')->with('success','Successfully Updated!');






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //category delete code
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.categories.index')
                        ->with('success','Item deleted successfully');
    }




      public function activate($id){

        //category activate code
        Category::where('id',$id)->update(['action'=>1]);
        return redirect()->route('admin.categories.index');
    }

    public function deactivate($id){
        //category deactivate code
        Category::where('id',$id)->update(['action'=>0]);
        return redirect()->route('admin.categories.index');
    }






}
