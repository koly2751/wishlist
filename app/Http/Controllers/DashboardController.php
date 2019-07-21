<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\User;
use App\Admin;
use App\Product;
use App\Review;

class DashboardController extends Controller
{

    public $user;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function __construct(User $user){

        //$this->user= $user->latest()->get();

        $this->middleware('auth:admin');

    }
    public function index()
    {
      //return  $this->user= User::find(20)->notifications;
        //admin dashboard retun view.

        $data['lineData'] = [
            [
            'period' => '2011',
            'Sales'=> 50,
            'Earning' => 80,
            'Marketing' => 20
            ],
            [
            'period' => '2012',
            'Sales' => 130,
            'Earning' => 100,
            'Marketing' => 80
            ], 
            [
            'period' => '2013',
            'Sales' => 80,
            'Earning' => 60,
            'Marketing' => 70
            ], 
            [
            'period' => '2014',
            'Sales' => 70,
            'Earning' => 200,
            'Marketing' => 140
            ], 
            [ 
            'period'=> '2015',
            'Sales' => 180,
            'Earning' => 150,
            'Marketing' => 140
            ], 
            [
            'period' => '2016',
            'Sales' => 105,
            'Earning' => 100,
            'Marketing' => 80
            ],
            [
            'period' => '2017',
            'Sales' => 250,
            'Earning' => 150,
            'Marketing' => 200
            ]
            
        ];
        $data['reviews'] = Review::latest()->paginate(4);
        $data['users'] = User::all();
        $data['products'] = Product::all();
  //return $data;
        return view('back.dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    public function newuser(){

    $admin = Admin::where('type', null)->get();
    return view('back.layouts.newusertype',compact('admin'));
    

    }
}
