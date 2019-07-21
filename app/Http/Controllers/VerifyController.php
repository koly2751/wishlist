<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VerifyController extends Controller
{
    

    public function verify($token){

       $user= User::where('email_verification_token',$token)->firstOrFail();

       $user->update(['email_verification_token' => null, 'email_verified'=>1]);


         return redirect()->route('cart.index')->with('success','Thank you! You are Successfully Verified!');

    }



}

