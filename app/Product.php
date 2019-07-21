<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

     public function subcategory(){

        return $this->belongsTo('App\SubCategory');
   
    }

     public function brand(){

        return $this->belongsTo('App\Brand');
   
    }

    public function colors(){

        return $this->belongsToMany('App\Color')->withTimestamps();
   
    }

     public function sizes(){

        return $this->belongsToMany('App\Size')->withTimestamps();
   
    }


    public function medias(){

        return $this->belongsToMany('App\Media')->withTimestamps();
   
    }

    public function productsales(){


        return $this->hasMany('App\ProductSale');
    }


    public function reviews(){

        return $this->hasMany('App\Review');
    }


    


}
