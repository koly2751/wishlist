<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
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
        //code for backend  view page for admin
        $data['countries'] = Country::all();
       
        return view('back.country.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //code for admin vew create portion to view the form
        return view('back.country.create');
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



        //code for insert data in database

           //code for image
          $file = $request->file('logo');
        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = "";
            }
        } else {
            $ext = "";
        }

        //validation code 

        $validate = $request->validate(
            [
                'name' => 'required|min:1',
                
                //'picture' => 'required | mimes:jpeg,jpg,png | max:1000'
            ]
        );

        //code for other data insert
        $arr = new Country();
        $arr->name = $request->input("name");
        $arr->logo = $ext;
        $arr->action = $request->input("action");
        $arr->save();
        $insertId = $arr->id;

        if ($ext) {


            $file->move("backend/images/country", "country-$insertId.$ext");
        }
   return redirect()->route('admin.countries.index')->with('success','Successfully Inserted!');









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
        //code for view the edit page from admin view

        $country = Country::find($id);
        return view('back.country.edit',compact('country'));
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
       // code for update the code of country

        $file = $request->file('logo');



        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = $country->image;
            }
        } else {
            $ext = $country->image;
        }

        $country = Country::find($id);
        $country->name = $request->name;
        
        $country->logo=$ext;
        $country->action = $request->action;
//return $subcategories;
        // die();
        if ($country->save()) {

            if(file_exists("backend/images/country/country-$country->id")){
                
                 unlink("backend/images/country/country-$country->id.$ext");
            }
           
           if ($file) {
               # code...
             $file->move("backend/images/country", "country-$country->id.$ext");
           }

        }
        return redirect()->route('admin.countries.index')->with('success','Successfully Updated!');
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
        //code for delete

        $country = Country::find($id);
        $country->delete();
        return redirect()->route('admin.countries.index')
                        ->with('success','Item deleted successfully');
    }



    //function code for activate

      public function activate($id){
        Country::where('id',$id)->update(['action'=>1]);
        return redirect()->route('admin.countries.index');
    }

    //function code for deactivate

    public function deactivate($id){
        Country::where('id',$id)->update(['action'=>0]);
        return redirect()->route('admin.countries.index');
    }
}
