<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    echo "clear";
});

Route::get('/', function () {
    return redirect('/backoffice/home');
});

//  ============================    Authentication Routes Start   ============================

Route::group(['prefix' => 'backoffice', 'namespace' => 'Auth', 'as' => 'auth.'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('admin_login');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('change_password', 'ChangePasswordController@showChangePasswordForm')->name('change_password');
    Route::patch('change_password', 'ChangePasswordController@changePassword')->name('change_password');
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('backoffice.password.reset');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset');
});

//  ============================    Authentication Routes End       ============================

//  ============================    Admin Routes Start       ============================

Route::group(['middleware' => 'auth', 'prefix' => 'backoffice', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('products', 'ProductController');
    Route::get('product_export', 'ProductController@productExport')->name('export');
    Route::resource('category', 'CategoryController');
});

//  ============================    Admin Routes End       ============================