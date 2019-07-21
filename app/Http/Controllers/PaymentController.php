<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class PaymentController extends Controller
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
        //admin view page code for that portion
        $data['payments'] = Payment::all();
       
        return view('back.payment.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //code for see up the create form
        return view('back.payment.create');
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


        //validation 
        $validate = $request->validate(
            [
                'name' => 'required|min:1',
                
                
            ]
        );

        //insrt data in database
        $arr = new Payment();
        $arr->name = $request->input("name");
        $arr->logo = $ext;
        $arr->action = $request->input("action");
        $arr->save();
        $insertId = $arr->id;

        if ($ext) {
            $file->move("backend/images/payment", "payment-$insertId.$ext");
        }
  
   return redirect()->route('admin.payments.index')->with('success','Successfully Inserted!');
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
         $payment = Payment::find($id);
         return view('back.payment.edit',compact('payment'));
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
        //code for update the code
        $file = $request->file('logo');

        $payment = payment::find($id);
         //code for update the image  
        if ($file) {
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
                $ext = $payment->logo;
            }
        } else {
            $ext = $payment->logo;
        }
        //update code for other datas
        $payment->name = $request->name;
        
        $payment->action = $request->action;

        $id = $payment->id;
          //image update code

        if ( $payment->save()) {

            if (file_exists("backend/images/payment/payment-$id")) {
                # code...

                unlink("backend/images/payment/payment-$id");
            }
            
            $file->move("back/images/payment", "payment-$id.$ext");
        }

        
       
        return redirect()->route('admin.payments.index')->with('success','Item updated successfully');;
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
        $payment = Payment::find($id);
        $payment->delete();
        return redirect()->route('admin.payments.index')
                        ->with('success','Item deleted successfully');

        
    }

//code for delete portion

      public function activate($id){
        Payment::where('id',$id)->update(['action'=>1]);
        return redirect()->route('admin.payments.index');
    }

 //code for deactivate function

    public function deactivate($id){
        Payment::where('id',$id)->update(['action'=>0]);
        return redirect()->route('admin.payments.index');
    }
}
