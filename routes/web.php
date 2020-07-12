<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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
Auth::routes();

Route::get('/', function(){
    return view('welcome');
});

Route::get('/logout', 'HomeController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('user')->group(function(){  
    Route::get('/alugar', 'Renting\alugar@indexview')->middleware('auth');;
});

Route::prefix('admin')->group(function () {
    Route::get('/alugados', 'Renting\alugados@indexview')->middleware('auth');;
    Route::get('/modelos', 'CarModels\carscontroller@indexview')->middleware('auth');;
    Route::get('/cars', 'Cars\carmodelscontroller@indexview')->middleware('auth');;
    
});