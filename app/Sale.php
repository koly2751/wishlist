<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function payment(){

    	return $this->belongsTo('App\Payment');
    }



    public function shipping(){

    	return $this->belongsTo('App\Shipping');
    }


    public function wrapp(){

    	return $this->belongsTo('App\Wrapp');
    }



  public function productsales(){


        return $this->hasMany('App\ProductSale');
    }

}


