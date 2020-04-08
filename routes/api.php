<?php

Route::get('rajaongkir/province', 'RajaOngkirController@getProvince')->name('rajaongkir.province');
Route::get('rajaongkir/city/{province_id}', 'RajaOngkirController@getCity')->name('rajaongkir.city');
Route::post('rajaongkir/cost', 'RajaOngkirController@getCost')->name('rajaongkir.cost');
