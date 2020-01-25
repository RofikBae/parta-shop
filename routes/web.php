<?php

use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $user = $request->user();

    dd($user->syncRole(['admin', 'user']));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', function () {
    return 'admin';
})->middleware('role:admin');
