<?php

Route::get('/', function () {
    return view('admin.index');
});

Route::resource('/category', 'CategoryController');
Route::resource('/product', 'ProductController');
