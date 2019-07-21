<?php

namespace App;
use App\User;
use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    public $user;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_number','password','email_verified_at', 'email_verified','email_verification_token',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function verified(){

        return $this->email_verification_token == null;
    }

   

    public function sales(){

        return $this->hasMany('App\Sale');
    }
    public function productsales(){

        return $this->hasMany('App\Sale');
    }


    public function reviews(){

        return $this->hasMany('App\Review');
    }





}
