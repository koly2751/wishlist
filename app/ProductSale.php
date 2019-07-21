<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    //



    //  relation between productsale and user
     public function user(){

        return $this->belongsTo('App\User');
    }

      public function sale(){


        return $this->belongsTo('App\Sale');
    }

    public function wrapp(){


        return $this->belongsTo('App\Wrapp');
    }

    public function product(){


        return $this->belongsTo('App\Product');
    }


    public function color(){


        return $this->belongsTo('App\Color');
    }

      public function size(){


        return $this->belongsTo('App\Size');
    }


}
