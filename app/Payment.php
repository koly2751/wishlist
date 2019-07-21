<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

     public function sales(){

    	return $this->hasMany('App\Sale');
    }

    public function productsales(){


        return $this->belongsTo('App\ProductSale');
    }

}
