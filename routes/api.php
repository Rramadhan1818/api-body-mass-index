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
Route::get('/check-ideal', 'CheckIdealController@index');
Route::post('/bmi-check', 'CheckIdealController@bmiStore');
Route::post('/bmr-check', 'CheckIdealController@bmrStore');
