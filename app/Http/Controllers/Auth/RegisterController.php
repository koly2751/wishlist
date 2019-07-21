<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\VerifyEmail;
use App\Notifications\NotifyAdmin;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        //str_replace($request->url(), '',$request->fullUrl());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number'=>'required|string|min:11',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number'=>$data['phone_number'],
            'password' => Hash::make($data['password']),
            'type' => '1',
            'email_verification_token'=> str_random(32),
        ]);

        $user = User::latest()->first();
        $user->notify(new VerifyEmail($user));

        // $admin =User::find(20);
        // $admin->notify(new NotifyAdmin($user));

        return $user;

    
    }
    
    public function redirectTo(){
        $url = redirect()->intended($this->redirectTo)->getTargetUrl();
        return $url;
    }


    // public function verifyEmail($token = null){

    //     if($token==null){
    //         session()->flash('type','warning');
    //         session()->flash('message','Invalid token');

    //         return redirect()->route('login');

    //         $user =User::where('email_verification_token',$token)->first();

    //         if($user==null){

    //         session()->flash('type','warning');
    //         session()->flash('message','Invalid token');

    //         return redirect()->route('login');

    //         }

    //         $user->update([

    //             'email_verified' => 1,
    //             'email_verified_at' => carbon::now(),
    //             'email_verification_token' => ''



    //         ]);
    //     }



    // }

    
}
