<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

class OfferController extends Controller
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

        $data['offers'] = Offer::all();
       
        
        return view('back.offer.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('back.offer.create');
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

          $file = $request->file('image');
        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = "";
            }
        } else {
            $ext = "";
        }







         $validate = $request->validate(
            [
                'title' => 'required|min:1',
                 'description' => 'required|min:5',
                 'type' => 'required'
                
            ]
        );


        $str = $request->input("description");
        $arr = new Offer();
        $arr->title = $request->input("title");
        $arr->logo = $ext;
        $arr->value = $request->input('offer_value');
        $arr->type  = $request->input("type");
        $arr->action = $request->input("action");
        $arr->save();
        $insertId = $arr->id;

        Storage::put("files/offers/$insertId.txt", $str);

        if ($ext) {
            $file->move("backend/images/offer", "offer-$insertId.$ext");
        }
  
    return redirect()->route('admin.offers.index')->with('success','Successfully Inserted!');
    











    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        //

        $offer = Offer::find($offer->id);

        return view('back.offer.edit',compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        //


        $file = $request->file('image');
       
     

        $offer = Offer::find($offer->id);
       
           
        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = $offer->image;
            }
        } else {
            $ext = $offer->image;
        }




        $offer->title = $request->title;
        $str = $request->input("description");
        $offer->type = $request->type;
        
        $offer->action = $request->action;
    
 

        $id = $offer->id;
        

        

     if ($offer->save()) {

            if(file_exists("backend/images/offer/offer-$id")){
                
                 unlink("backend/images/offer/offer-$id");
            }
             
             if($file){
                
                 $file->move("backend/images/offer", "offer-$id.$ext");
             }

             Storage::put("files/offers/$id.txt", $str);
           
        }
        
        return redirect()->route('admin.offers.index');













    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $offer = Offer::find($id);
        $offer->delete();
        return redirect()->route('admin.offers.index')
                        ->with('success','Item deleted successfully');
    }




      public function activate($id){
        Offer::where('id',$id)->update(['action'=>1]);
        return redirect()->route('admin.offers.index');
    }

    public function deactivate($id){
        Offer::where('id',$id)->update(['action'=>0]);
        return redirect()->route('admin.offers.index');
    }
}
