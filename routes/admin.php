<?php

Route::get('/', function () {
    return view('admin.index');
});

Route::resource('/category', 'CategoryController');
Route::resource('/product', 'ProductController');


// $router->group(['prefix' => 'category', 'namespace' => 'Category'], function ($router) {
//     $router->get('list',                  ['uses' => 'ListController']);
    // $router->post('create',               'CreateController');
    // $router->post('update/{id:[0-9]+}',   'UpdateController');
    // $router->delete('delete/{id:[0-9]+}', 'DeleteController');
// });
