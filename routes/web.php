<?php

// VIEWS
Route::get("/", "HomeController@index")->name("home");
Route::get("/proizvodi", "ProductsController@showProducts")->name("products");
Route::get("/proizvodi/{productName}", "ProductsController@showOneProduct")->name("product");
Route::get("/galerija", "GalleryController@index")->name('gallery');
Route::get("/kontakt", "ContactController@showContact")->name('contact');
Route::get("/autor", "HomeController@author")->name('author');

// contact form submit 
Route::post("/kontakt", "ContactController@contactFormSubmit")->name('contactFormSubmit');

// LOGIN
Route::get("/autentifikacija", "AuthController@loginRegisterView")->name('loginRegisterView')->middleware('authPages');
Route::post("/logovanje", "AuthController@doLogin")->name("doLogin");
Route::post("/registracija", "AuthController@doRegister")->name("doRegister");
Route::get("/odjava", "AuthController@logout")->name('logout');

// Cart
Route::post("/korpa", "CartController@addItem")->name("cartAddProduct");
Route::get("/korpa", "CartController@showCart")->name("cartView")->middleware('cartAccess');
Route::delete("/korpa/{id}", "CartController@deleteItem")->name("cartDeleteItem");
Route::get("/porudzbine", "CartController@userOrders")->name("ordersView")->middleware('cartAccess');
// Orders
Route::post("/porudzbina", "CartController@order")->name("order");


// Admin routes
Route::group(['middleware' => 'admin'], function(){
    Route::resource("admin/korisnici", "Admin\UsersController");
    Route::resource("admin/proizvodi", "Admin\ProductsController");
    Route::resource("admin/galerija", "Admin\GalleryController");
    Route::resource("admin/porudzbine", "Admin\OrdersController");
    Route::get("admin/logFile", "Admin\LogFileController@index")->name('logger');
    // upload samo slike
    Route::put("admin/proizvodi", "Admin\ProductsController@updatePicture")->name('updatePicture');
    //log file
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logger');
});

// AJAX
Route::get("/ajax/korisnici", "Admin\UsersController@getAllUsers");
Route::get("/ajax/galerija", "GalleryController@showGallery");
Route::get("/ajax/galerijaFilter", "GalleryController@galleryFilter");

//
Route::fallback(function(){
    abort(404);
});