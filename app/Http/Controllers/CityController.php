<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\City;

class CityController extends Controller
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
        //all data show in index

         $data['cities'] = City::latest()->get();
       
        return view('back.city.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //INSERT FORM VIEW
        $countries = Country::all();
        return view('back.city.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //validation code

             $validate = $request->validate(
            [
                'name' => 'required|min:1',
                
               
            ]
        );
             //city insert data code

         $arr = new City();
        $arr->name = $request->input("name");
           
        $arr->country_id=$request->input("country_id");
         $arr->charge = $request->input("charge"); 
        $arr->action = $request->input("action");
        $arr->save();
        return redirect()->route('admin.cities.index')->with('success','Successfully Inserted!');



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
//EDIT VIEW

         $city = City::find($id);

        $countries = Country::all();
       
        

        return view('back.city.edit',compact('city','countries'));
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
        //UPDATE CODE FOR CITY 

          $city = City::find($id);
          $city->name= $request->name;
          $city->country_id=$request->country_id;
          $city->charge=$request->charge;
          $city->action=$request->action;
          $city->save();
          return redirect()->route('admin.cities.index');
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

        $city = City::find($id);
        $city->delete();
        return redirect()->route('admin.cities.index')
                        ->with('success','Item deleted successfully');
    }


      public function activate($id){

        //ACTIVATE CODE FOR CITY
        City::where('id',$id)->update(['action'=>1]);
        return redirect()->route('admin.cities.index');
    }

    public function deactivate($id){

        //activate code for deactive
        City::where('id',$id)->update(['action'=>0]);
        return redirect()->route('admin.cities.index');
    }
}
