<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\LoginController@register');

Route::post('/searchHotel', 'TempSearchController@index');
Route::post('/search', 'TempSearchController@store');

// Route::get('/hotel', 'HotelController@index');
Route::get('/hotel/{id}', 'HotelController@show');
Route::get('/hotel/{hotelId}/room/{roomId}', 'HotelController@show2');
Route::get('/getSearch/{token}', 'TempSearchController@show');

Route::post('/booking', 'BookingController@store');
