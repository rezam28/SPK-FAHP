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
Route::get('/alternatif','AlternatifController@index')->name('alternatif');
Route::get('/kriteria','KriteriaController@index')->name('kriteria');

Route::get('/logout','LoginController@Logout')->name('logout');

Route::group(['middleware' => 'logged'], function()
{
    Route::get('/login','LoginController@index')->name('login');
    Route::post('/postlogin','LoginController@postlogin')->name('login');
});

Route::group(['middleware' => 'admin'], function()
{
    Route::get('/admin','Admin\HomeController@index')->name('ad_home');

    //Alternatif
    Route::get('/admin/alternatif','AlternatifController@admin')->name('ad_alternatif');
    Route::post('/admin/alternatif','AlternatifController@store')->name('ad_alternatif');
    Route::get('/admin/alternatif/{alternatif_id}/edit','AlternatifController@edit');
    Route::delete('/admin/alternatif{alternatif_id}','AlternatifController@destroy');
    
    //Kriteria
    Route::get('/admin/kriteria','KriteriaController@admin')->name('ad_kriteria');
    Route::post('/admin/kriteria','KriteriaController@store')->name('ad_kriteria');
    Route::get('/admin/kriteria/{kriteria_id}/edit','KriteriaController@edit');
    Route::delete('/admin/kriteria{kriteria_id}','KriteriaController@destroy');

    //Perbandingan Kriteria
    Route::get('/admin/perbandingan-kriteria','PerbandingankriteriaController@admin')->name('ad_pk');
    Route::post('/admin/perbandingan-kriteria','PerbandingankriteriaController@store')->name('ad_pk');
    Route::get('/admin/perbandingan-kriteria/{daerah}','PerbandingankriteriaController@daerah');
    Route::delete('/admin/perbandingan-kriteria{perbandingankriteria_id}','PerbandinganKriteriaController@destroy');
    
    //Perbandingan Alternatif
    Route::get('/admin/perbandingan-alternatif','PerbandinganalternatifController@admin')->name('ad_pa');

    Route::get('/admin/peta','PetaController@admin')->name('ad_peta');
});