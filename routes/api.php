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
Route::post('/check-user-login', 'Api\AuthController@checkIsLoggedIn')->name('api.check-user-login');
Route::post('/logout', 'Api\AuthController@logout')->name('api.logout');

//presensi 
Route::post('/get-data-presensi', 'Api\PresensiController@getData')->name('api.get-data-presensi');
Route::post('/get-data-presensi-by-guru', 'Api\PresensiController@getDataGuru')->name('api.get-data-presensi-by-guru');
Route::post('/input-data-presensi', 'Api\PresensiController@inputPresensi')->name('api.input-data-presensi');
Route::get('/get-data-jadwal', 'Api\PresensiController@getJadwalPresensi')->name('api.get-data-jadwal');
Route::post('/get-data-detail-jadwal', 'Api\PresensiController@getDetailJadwalPresensi')->name('api.get-data-detail-jadwal');

//hafalan 
Route::get('/get-data-murid', 'Api\PencatatanController@getMurid')->name('api.get-data-murid');
Route::post('/get-data-hafalan', 'Api\HafalanController@getData')->name('api.get-data-hafalan');
Route::get('/get-data-hafalan-by-guru', 'Api\HafalanController@getDataByGuru')->name('api.get-data-hafalan-by-guru');
Route::post('/input-data-hafalan', 'Api\HafalanController@inputHafalan')->name('api.input-data-hafalan');
Route::get('/get-data-hafalan-id/{id}', 'Api\HafalanController@getDataById')->name('api.get-data-hafalan-id');
Route::post('/update-data-hafalan', 'Api\HafalanController@updateData')->name('api.update-data-hafalan');
Route::delete('/delete-data-hafalan/{id}', 'Api\HafalanController@delete')->name('api.delete-data-hafalan');

//pencatatan 
Route::get('/get-data-murid', 'Api\PencatatanController@getMurid')->name('api.get-data-murid');
Route::get('/get-data-alquran', 'Api\PencatatanController@getDataAlquran')->name('api.get-data-alquran');
Route::post('/get-data-pencatatan', 'Api\PencatatanController@getData')->name('api.get-data-pencatatan');
Route::get('/get-data-pencatatan-by-guru', 'Api\PencatatanController@getDataGuru')->name('api.get-data-pencatatan-by-guru');
Route::post('/input-data-pencatatan', 'Api\PencatatanController@inputPencatatan')->name('api.input-data-pencatatan');
Route::get('/get-data-pencatatan-id/{id}', 'Api\PencatatanController@getDataById')->name('api.get-data-pencatatan-id');
Route::post('/update-data-pencatatan', 'Api\PencatatanController@updateData')->name('api.update-data-pencatatan');


//pembayaran
Route::get('/get-data-pembayaran-id/{id}', 'Api\PembayaranController@getDataById')->name('api.get-data-pembayaran-id');
Route::post('/get-data-pembayaran', 'Api\PembayaranController@getData')->name('api.get-data-pembayaran');
Route::post('/input-data-pembayaran', 'Api\PembayaranController@inputPembayaran')->name('api.input-data-pembayaran');
Route::post('/update-data-pembayaran', 'Api\PembayaranController@updateData')->name('api.update-data-pembayaran');

//agenda
Route::get('/get-data-agenda', 'Api\AgendaController@getData')->name('api.get-data-agenda');