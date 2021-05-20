<?php

use App\Http\Controllers\PetaController;
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

//peta
Route::get('/peta','PetaController@index')->name('peta');

//daerah
Route::get('/daerah','DaerahController@index')->name('daerah');
//hasil
Route::get('/hasil','HasilController@index')->name('hasil');
Route::post('/hasil','HasilController@hasil')->name('hasil');

//alternatif
Route::get('/alternatif','AlternatifController@index')->name('alternatif');

//kriteria
Route::get('/kriteria','KriteriaController@index')->name('kriteria');

Route::get('/logout','LoginController@Logout')->name('logout');

Route::group(['middleware' => 'logged'], function()
{
    Route::get('/login','LoginController@index')->name('login');
    Route::post('/postlogin','LoginController@postlogin')->name('login');
});

Route::group(['middleware' => 'admin'], function()
{
    Route::get('/admin', function () {
        return redirect('/admin/pemetaan');
    });
    // Route::get('/admin','Admin\HomeController@index')->name('ad_home');

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

    //daerah
    Route::get('/admin/daerah','DaerahController@admin')->name('ad_daerah');
    Route::post('/admin/daerah','DaerahController@store')->name('ad_daerah');
    Route::get('/admin/daerah/{daerah_id}/edit','DaerahController@edit');
    Route::delete('/admin/daerah{daerah_id}','DaerahController@destroy');

    //Perbandingan Kriteria
    Route::get('/admin/perbandingan-kriteria','PerbandingankriteriaController@admin')->name('ad_pk');
    // Route::get('/admin/perbandingan-kriteria/json','PerbandingankriteriaController@json')->name('pk_json');
    Route::post('/admin/perbandingan-kriteria','PerbandingankriteriaController@store')->name('ad_pk');
    Route::get('/admin/perbandingan-kriteria/{daerah}','PerbandingankriteriaController@daerah');
    Route::delete('/admin/perbandingan-kriteria{perbandingankriteria_id}','PerbandinganKriteriaController@destroy');
    
    //Perbandingan Alternatif
    Route::get('/admin/perbandingan-alternatif','PerbandinganalternatifController@admin')->name('ad_pa');
    Route::post('/admin/perbandingan-alternatif','PerbandinganalternatifController@store')->name('ad_pa');
    Route::get('/admin/perbandingan-alternatif/{kriteria}','PerbandinganalternatifController@kriteria');
    Route::delete('/admin/perbandingan-alternatif{perbandinganalternatif_id}','PerbandinganalternatifController@destroy');

    //Peta
    Route::get('/admin/pemetaan','PetaController@admin')->name('ad_pemetaan');
    Route::post('/admin/pemetaan','PetaController@store')->name('ad_pemetaan');
    Route::get('/admin/pemetaan/{id}','PetaController@peta')->name('edit_pemetaan');
    Route::delete('/admin/pemetaan{id}','PetaController@destroy');
    Route::post('admin/update/pemetaan/{id}','PetaController@update');
});