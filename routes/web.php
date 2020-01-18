<?php

use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $user = $request->user();

    dd($user->updatePermission(['add product', 'edit product', 'delete product']));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
