<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
Route::get('lang/{lang}', function ($lang) {
    session()->has('lang') ? session()->forget('lang') : '';
    $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
    return back();
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Config::set('auth.defaults.guard', 'admin');

    Route::group(['middleware' => 'guestAdmin'], function () {
        Route::get('/login', 'AdminAuthController@login');
        Route::get('/forgot-password', 'AdminAuthController@forgotPassword');
        Route::get('/reset-password/{token}', 'AdminAuthController@reset_password');
        Route::post('/login', 'AdminAuthController@loginAction');
        Route::post('/forgot-password', 'AdminAuthController@forgotPasswordAction');
        Route::post('/reset-password/{token}', 'AdminAuthController@reset_passwordAction');
    });

    Route::group(['middleware' => 'admin:admin'], function () {
        Route::any('/logout', 'AdminAuthController@logout');

        Route::get('/', function () {
            return view('admin.home');
        });

        Route::resource('roles', 'RolesController');
        Route::resource('accounts/admins', 'AdminController');
        Route::resource('accounts/users', 'UserController');
        Route::get('settings', 'WebsiteSettingsController@settings');
        Route::post('settings', 'WebsiteSettingsController@update_settings');
        Route::resource('countries', 'CountryController');
        Route::resource('cities', 'CityController');
        Route::resource('states', 'StateController');
        Route::resource('departments', 'DepartmentController');
        Route::resource('trademarks', 'TrademarkController');
        Route::resource('manufacturers', 'ManufactController');
        Route::resource('shippings', 'ShippingController');
        Route::resource('malls', 'MallController');
        Route::resource('colors', 'ColorController');
        Route::resource('sizes', 'SizeController');
        Route::resource('weights', 'WeightController');
        Route::resource('products', 'ProductController');
        Route::post('load-weight-size', 'ProductController@get_weight_size');
        Route::post('product/copy', 'ProductController@copy');
        Route::patch('product/copy', 'ProductController@copy');
        Route::post('product/search', 'ProductController@search');
    });

});
