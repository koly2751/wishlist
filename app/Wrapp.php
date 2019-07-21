<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wrapp extends Model
{
    //

    public function sales(){

    	return $this->hasMany('App\Sale');
    }
    

    public function productsales(){


        return $this->hasMany('App\ProductSale');
    }


}
