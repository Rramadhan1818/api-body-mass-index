<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route Auth
Route::post('auth/login', 'AuthController@login');
Route::post('auth/register', 'AuthController@register');

//Route User
Route::get('/users', 'UserController@index');
Route::post('/users-store', 'UserController@store');
// Route::get('/users/{id?}', 'UserController@show');
// Route::post('/users/update/{id?}', 'UserController@update');
// Route::delete('/users/{id?}', 'UserController@destroy');

//Route Category
Route::get('/category', 'CategoryController@index');

//Route Check Ideal
Route::get('/bmi-check', 'CheckBmiController@index');
Route::get('/bmi-check/{id}', 'CheckBmiController@getBmiById');
Route::post('/bmi-check', 'CheckBmiController@bmiStore');

Route::get('/bmr-check', 'CheckBmrController@index');
Route::get('/bmr-check/{id}', 'CheckBmrController@getBmrById');
Route::post('/bmr-check', 'CheckBmrController@bmrStore');

//Route Master lvl aktivitas
Route::get('/lvl-aktivitas', 'LvlActivityController@index');

