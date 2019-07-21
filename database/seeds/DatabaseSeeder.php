<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //  $this->call(CategoriesTableSeeder::class);

        //  $this->call(ProductsTableSeeder::class);

        // $this->call(BrandTableSeeder::class);
        //  $this->call(SizesTableSeeder::class);

        // $this->call(ColorsTableSeeder::class);
        // $this->call(PaymentTableSeeder::class);
        // $this->call(WrappTableSeeder::class);
        //$this->call(ReviewTableSeeder::class);
        // $this->call(ShippingsTableSeeder::class);
        // $this->call(CityTableSeeder::class);
        // $this->call(OfferTableSeeder::class);
        // $this->call(MediaTableSeeder::class);
        // $this->call(MediaProductTableSeeder::class);

         // factory(\App\Media::class,723)->create()->each(function($item){
         //    $pro = 30;
         //    $c = 1;
         //    if($c%3 == 0){
         //        $pro++;
         //    }
         //    $item->products->attach($pro);
         //    $c++;
         // });


       //   factory(App\Product::class, 50)->create()->each(function ($product){

       //     $productable = ['color', 'size'];
       //     $color = array_rand(App\Color::get()->toArray(), 3);
       //     $size = array_rand(App\Size::get()->toArray(), 3);
       //     $product->colors()->attach($color);
       //     $product->sizes()->attach($size);
       // });


//for media table seeder code
        $product = 30;
        $media = 30;

        for($media; $media<=741; $media++){
           DB::table('media_product')->insert([
            'product_id' => $product,
            'media_id' => $media,
        ]);

        if($media%3 == 0){
                 $product++;
           } 
        }
        



    }
}
