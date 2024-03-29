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

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', function () {
    return redirect('/peta');
});
Route::get('/peta','PetaController@index')->name('peta');
Route::get('/hasil','HasilController@index')->name('hasil');
Route::post('/hasil','HasilController@hasil')->name('hasil');

Route::get('/login','LoginController@index')->name('login');
Route::post('/postlogin','LoginController@postlogin')->name('login');

Route::get('/admin','Admin\HomeController@index')->name('admin');
Route::get('/logout','LoginController@Logout')->name('logout');