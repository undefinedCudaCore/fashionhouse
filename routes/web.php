<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'masters'], function(){
    Route::get('', 'MasterController@index')->name('master.index');
    Route::get('create', 'MasterController@create')->name('master.create');
    Route::post('store', 'MasterController@store')->name('master.store');
    Route::get('edit/{master}', 'MasterController@edit')->name('master.edit');
    Route::post('update/{master}', 'MasterController@update')->name('master.update');
    Route::post('delete/{master}', 'MasterController@destroy')->name('master.destroy');
    Route::get('show/{master}', 'MasterController@show')->name('master.show');
 });

 Route::group(['prefix' => 'outfits'], function(){
    Route::get('', 'OutfitController@index')->name('outfit.index');
    Route::get('create', 'OutfitController@create')->name('outfit.create');
    Route::post('store', 'OutfitController@store')->name('outfit.store');
    Route::get('edit/{outfit}', 'OutfitController@edit')->name('outfit.edit');
    Route::post('update/{outfit}', 'OutfitController@update')->name('outfit.update');
    Route::post('delete/{outfit}', 'OutfitController@destroy')->name('outfit.destroy');
    Route::get('show/{outfit}', 'OutfitController@show')->name('outfit.show');
 });