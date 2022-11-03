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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// user
Route::post('/login', 'Api\AuthController@login')->name('api.login');
Route::post('/get-data', 'Api\AuthController@getData')->name('api.get-data');
Route::post('/update', 'Api\AuthController@update')->name('api.update');
Route::post('/logout', 'Api\AuthController@logout')->name('api.logout');

//presensi 
Route::post('/get-data-presensi', 'Api\PresensiController@getData')->name('api.get-data-presensi');
Route::post('/get-data-presensi-by-guru', 'Api\PresensiController@getDataGuru')->name('api.get-data-presensi-by-guru');
Route::post('/input-data-presensi', 'Api\PresensiController@inputPresensi')->name('api.input-data-presensi');

//hafalan 
Route::post('/get-data-hafalan', 'Api\HafalanController@getData')->name('api.get-data-hafalan');
Route::post('/get-data-hafalan-by-guru', 'Api\HafalanController@getDataByGuru')->name('api.get-data-hafalan-by-guru');
Route::post('/input-data-hafalan', 'Api\HafalanController@inputHafalan')->name('api.input-data-hafalan');

//pencatatan 
Route::post('/get-data-pencatatan', 'Api\PencatatanController@getData')->name('api.get-data-pencatatan');
Route::post('/get-data-pencatatan-by-guru', 'Api\PencatatanController@getDataGuru')->name('api.get-data-pencatatan-by-guru');
Route::post('/input-data-pencatatan', 'Api\PencatatanController@inputPencatatan')->name('api.input-data-pencatatan');

//pembayaran
Route::post('/get-data-pembayaran', 'Api\PembayaranController@getData')->name('api.get-data-pembayaran');
Route::post('/input-data-pembayaran', 'Api\PembayaranController@inputPembayaran')->name('api.input-data-pembayaran');

//agenda
Route::get('/get-data-agenda', 'Api\AgendaController@getData')->name('api.get-data-agenda');