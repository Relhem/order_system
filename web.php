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

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/orders', 'OrdersController@showOrdersList')->middleware('auth');
Route::post('/create', 'OrdersController@createNewOrder')->middleware('auth');
Route::delete('/deleteOrder/{orderId}', 'OrdersController@destroy')->middleware('auth');
Route::post('/editDescription/{orderId}', 'OrdersController@editDescription')->middleware('auth');
Route::post('/setStatus/{orderId}', 'OrdersController@setStatus')->middleware('auth');
Route::post('/changePayed/{orderId}', 'OrdersController@changePayed')->middleware('auth');
Route::get('/upload/{orderId}', 'IndexController@upload') -> middleware('auth');
Route::post('/upload/{orderId}', 'UploadController@upload')->name('upload') -> middleware('auth');
Route::get('/getImages/{orderId}', 'ImagesController@getImages')->middleware('auth');
Route::post('/deleteImage', 'ImagesController@destroy')->middleware('auth');
Route::get('/downloadImage', 'ImagesController@download');
Route::get('/order', 'OrderController@index');
Route::get('/order/{orderKey}', 'OrderController@getOrderInfo');