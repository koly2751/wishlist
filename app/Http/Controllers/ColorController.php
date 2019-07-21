<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
class ColorController extends Controller
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

         $data['alldatas'] = Color::all();
       
        return view('back.color.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('back.color.create');
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

        //insert code for color start


        //validation code for color
        $validate = $request->validate(
            [
                'name' => 'required|min:1',
                
                
            ]
        );

        //insert code
        $arr = new Color();
        $arr->name = $request->input("name");
        $arr->action = $request->input("action");
        $arr->save();

         return redirect()->route('admin.colors.index')->with('success','Successfully Inserted!');

         //end of insert portion code
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
        //portion for edit the color code
         $color = Color::find($id);
       
        

        return view('back.color.edit',compact('color'));
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
        //portion for update the code of color
          $color = Color::find($id);
          $color->name= $request->name;
          $color->action=$request->action;
          $color->save();
          return redirect()->route('admin.colors.index');
          //end portion of color
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //code for delete portion 

        $color = Color::find($id);
        $color->delete();
        return redirect()->route('admin.colors.index')
                        ->with('success','Item deleted successfully');
    }



    //active portion code
     public function activate($id){
        Color::where('id',$id)->update(['action'=>1]);
        return redirect()->route('admin.colors.index');
    }
    
    //deactive portion code

    public function deactivate($id){
        Color::where('id',$id)->update(['action'=>0]);
        return redirect()->route('admin.colors.index');
    }
}
