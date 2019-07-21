<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;

class SubCategoryController extends Controller
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
        //code for view feom admin side
        $data['allsubcategories'] = SubCategory::all();
       
        return view('back.subcategory.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //code for insert form
         $categories = Category::all();
         return view('back.subcategory.create',compact('categories'));
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
        //insert code
        //insert code for image
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
                'name' => 'required|min:1',
                
               
            ]
        );

        $arr = new SubCategory();
        $arr->name = $request->input("name");
        $arr->image = $ext;
        $arr->category_id=$request->input("category_id");
        
        $arr->action = $request->input("action");

        $arr->save();


        $insertId = $arr->id;

         if ($ext) {
            $file->move("backend/images/subcategories", "subcategory-$insertId.$ext");
        }

        return redirect()->route('admin.subcategories.index');

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
        //code for view the edit form from admin side
        $cats = Category::all();

        $subcategories = SubCategory::find($id);
       
        //return $subcategories;

        return view('back.subcategory.edit',compact('subcategories','cats'));
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
      
        //update code

        $file = $request->file('image');



        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = $subcategories->image;
            }
        } else {
            $ext = $subcategories->image;
        }

        $subcategories = SubCategory::find($id);
        $subcategories->name = $request->name;
        $subcategories->category_id=$request->category_id;
        $subcategories->image=$ext;
        $subcategories->action = $request->action;
        //return $subcategories;
        // die();


        //update code for image

        if ($subcategories->save()) {

            if(file_exists("backend/images/subcategories/subcategory-$subcategories->id")){
                
                 unlink("backend/images/subcategories/subcategory-$subcategories->id.$ext");
            }
           
           if ($file) {
               # code...
             $file->move("backend/images/subcategories", "subcategory-$subcategories->id.$ext");
           }

        }
        return redirect()->route('admin.subcategories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        //delete code
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index')
                        ->with('success','Item deleted successfully');
    }


    //code for active portion
      public function activate($id){
        SubCategory::where('id',$id)->update(['action'=>1]);
        return redirect()->route('admin.subcategories.index');
    }
//code for deactive portion
    public function deactivate($id){
        SubCategory::where('id',$id)->update(['action'=>0]);
        return redirect()->route('admin.subcategories.index');
    }


}
