<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/tt', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);



//group routing
Route::prefix('admin')->group(function() {

Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/', 'AdminController@index')->name('admin.dashboard');
Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
Route::post('register', 'Auth\AdminRegisterController@register');

// Password reset routes
  Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
  Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/newuseradd', 'DashboardController@newuser')->name('dashboard.newuser');
Route::get('verifyy/{token}', 'VerifyController@verify')->name('verifyy');


//resource routing 

Route::group(['as'=>'admin.', 'prefix'=>'admin'], function(){

	
	  Route::resource('categories', 'CategoryController');
	  Route::get("/categories-activate/{id}", "CategoryController@activate");
    Route::get("/categories-deactivate/{id}", "CategoryController@deactivate");


    Route::resource('subcategories', 'SubCategoryController');
    Route::get("/subcategories-activate/{id}", "SubCategoryController@activate");
    Route::get("/subcategories-deactivate/{id}", "SubCategoryController@deactivate");


    Route::resource('products', 'ProductController');
    Route::post('/products/offer','ProductController@offerproduct')->name('poffer');
    Route::get("/products-activate/{id}", "ProductController@activate");
    Route::get("/products-deactivate/{id}", "ProductController@deactivate");
    Route::get('/drop', 'ProductController@drop')->name('drop');
     Route::post("/imageee", "ProductController@imageee")->name('product.image');
     Route::get('products/delete/{id}','ProductController@destroy')->name('products.delete');
     Route::post('/image-edit', 'ProductController@imageedit');

   Route::resource('brands', 'BrandController');
    Route::get("/brands-activate/{id}", "BrandController@activate")->name('brands.activate');
    Route::get("/brands-deactivate/{id}", "BrandController@deactivate");

    Route::resource('colors', 'ColorController');
   Route::get("/colors-activate/{id}", "ColorController@activate");
    Route::get("/colors-deactivate/{id}", "ColorController@deactivate");


     Route::resource('sizes', 'SizeController');
     Route::get("/sizes-activate/{id}", "SizeController@activate");
    Route::get("/sizes-deactivate/{id}", "SizeController@deactivate");


    Route::resource('wrapps', 'WrappController');
    Route::get("/wrapps-activate/{id}", "WrappController@activate");
    Route::get("/wrapps-deactivate/{id}", "WrappController@deactivate");


    Route::resource('payments', 'PaymentController');
    Route::get("/payments-activate/{id}", "PaymentController@activate")->name('payments.activate');
    Route::get("/payments-deactivate/{id}", "PaymentController@deactivate");



    Route::resource('cities', 'CityController');
    Route::get("/cities-activate/{id}", "CityController@activate")->name('cities.activate');
    Route::get("/cities-deactivate/{id}", "CityController@deactivate");


    Route::resource('countries', 'CountryController');
    Route::get("/countries-activate/{id}", "CountryController@activate")->name('countries.activate');
    Route::get("/countries-deactivate/{id}", "CountryController@deactivate");


    Route::resource('sales', 'SaleController');
    Route::get("/sales-activate/{id}", "SaleController@activate")->name('sales.activate');
    Route::get("/sales-deactivate/{id}", "SaleController@deactivate");


    Route::resource('offers', 'OfferController');
    Route::get("/offers-activate/{id}", "OfferController@activate")->name('offers.activate');
    Route::get("/offers-deactivate/{id}", "OfferController@deactivate");

});


Route::get('/', 'MainController@index')->name('home');
Route::get('my-notification/{type}', 'MainController@myNotification');


Route::group([ 'prefix'=>'user'], function(){


      Route::resource('usercategories', 'FrontCategoryController');
      Route::get("/usercategories-typee/{id}", "FrontCategoryController@typee")->name('typee');
      Route::resource('userproducts', 'FrontProductController');
      Route::resource('contacts', 'ContactController');
      Route::resource('cart', 'CartController');
      Route::resource('/user', 'CartController');
      Route::resource('checkoutregister', 'CheckoutController');
     
  });

  Route::get('/register', 'CheckoutController@register')->name('register');
  Route::get('/login', 'CartController@login')->name('login');
 Route::get('brands/{name}','FrontBrandController@brand')->name('brand.index');

 Route::post('/addtocart', 'ajax\AddToCartController@addcart')->name('addtocart');
 Route::get('/deletecart', 'ajax\AddToCartController@deleteCart')->name('deletecart');
 Route::get('/search', 'ajax\SearchController@search')->name('search');

 Route::get('/aboutus', 'MainController@about')->name('about');

 Route::get('/products/alloffer','FrontProductController@alloffer')->name('alloffer');
 Route::get('/products/offer/{offer}','FrontProductController@offer')->name('offer');

 Route::post('/products/review','ReviewController@review')->name('review');
 Route::get('/charge','CheckoutController@charge')->name('charge');
