<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wrapp;

class WrappController extends Controller
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
        //code for view all data from admin side
         $data['allwrapps'] = Wrapp::all();
        return view('back.wrapp.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //code for view the insert form
        return view('back.Wrapp.create');
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

        //code for insert data
        $file = $request->file('image');
        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = "";
            }
        } else {
            $ext = "";
        }

        // dd($request->all());

       //validation

        $validate = $request->validate(
            [
                'name' => 'required|min:1',
                
               
            ]
        );

        //code for insert data 
        $arr = new Wrapp();
        $arr->name = $request->input("name");
        $arr->image = $ext;
        $arr->price = $request->input("price");
        $arr->action = $request->input("action");
        $arr->save();
        $insertId = $arr->id;

         if ($ext) {
            $file->move("backend/images/wrapps", "wrapp-$insertId.$ext");
        }

        return redirect()->route('admin.wrapps.index')->with('success','Successfully Inserted!');



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
        //code for view the edit form
        $wrapp = Wrapp::find($id);
        return view('back.wrapp.edit',compact('wrapp'));
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
      //code for update

        $file = $request->file('image');

        $wrapp = Wrapp::find($id);
  
        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = $wrapp->image;
            }
        } else {
            $ext = $wrapp->image;
        }

        $wrapp->name = $request->name;
        
        $wrapp->action = $request->input('action');
 
        $id = $wrapp->id;

        if ($wrapp->save()) {

            if(file_exists("backend/images/wrapps/wrapp-$id")){
                
                 unlink("backend/images/wrapps/wrapp-$id");
            }
             
             if($file){
                
                 $file->move("backend/images/wrapps", "wrapp-$id.$ext");
             }
           
        }
       
        return redirect()->route('admin.wrapps.index')>with('success','Item Updted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete code for wrapping
        $wrapp = Wrapp::find($id);
        $wrapp->delete();
        return redirect()->route('admin.wrapps.index')
                        ->with('success','Item deleted successfully');
    }

    //activate code for wrapping
       public function activate($id){
        Wrapp::where('id',$id)->update(['action'=>1]);
        return redirect()->route('admin.wrapps.index');
    }

    //deactivate for wrapping
    public function deactivate($id){
        Wrapp::where('id',$id)->update(['action'=>0]);
        return redirect()->route('admin.wrapps.index');
    }
}
