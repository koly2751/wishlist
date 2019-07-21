<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;

class SizeController extends Controller
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
        //code for admin view for size
        $data['allsizes'] = Size::all();
       
        return view('back.size.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //code for insert form
        return view('back.size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //validation

        $validate = $request->validate(
            [
                'name' => 'required|min:1',
                
               
            ]
        );
        //insert code for  size 
        $arr = new Size();
        $arr->name = $request->input("name");
        $arr->action = $request->input("action");
        $arr->save();

        return redirect()->route('admin.sizes.index')->with('success','Successfully Inserted!');
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
        //code of view edit from from admin site
        $size = Size::find($id);
        return view('back.size.edit',compact('size'));
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
        //pictures for update the size code
          $size = Size::find($id);
          $size->name= $request->name;
          $size->action=$request->action;
          $size->save();
          return redirect()->route('admin.sizes.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //code for delete
        $size = Size::find($id);
        $size->delete();
        return redirect()->route('admin.sizes.index')
                        ->with('success','Item deleted successfully');
    }

    //code for active portion
     public function activate($id){
        Size::where('id',$id)->update(['action'=>1]);
        return redirect()->route('admin.sizes.index');
    }
    //code for deactivate portion
    public function deactivate($id){
        Size::where('id',$id)->update(['action'=>0]);
        return redirect()->route('admin.sizes.index');
    }
}
