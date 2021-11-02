<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'Maintenance'], function () {
    Route::get('/', function () {
        return view('user.home');
    });
    Route::get('/shop', function () {
        return view('user.shop');
    });
    Route::get('/cart', function () {
        return view('user.cart');
    });
});

Route::get('/maintenance', function () {
    if (website_setting()->status == 'open') {
        return redirect('/');
    }
    return view('user.maintenance');
});


