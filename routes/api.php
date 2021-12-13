<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Country routes
Route::get('countries', 'countryController@index');
Route::get('countries/{id}', 'countryController@show');
Route::post('countries', 'countryController@store');
Route::post('countriesPostFile', 'countryController@storeFile');
Route::put('countries/{id}', 'countryController@update');
Route::delete('countries/{id}', 'countryController@delete');
// City routes
Route::get('cities', 'cityController@index');
Route::get('cities/{id}', 'cityController@show');
Route::post('cities', 'cityController@store');
Route::post('citiesPostFile', 'cityController@storeFile');
Route::put('cities/{id}', 'cityController@update');
Route::delete('cities/{id}', 'cityController@delete');
