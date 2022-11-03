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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', [App\Http\Controllers\HomeController::class, 'login'])->name('welcome');
Route::group(['middleware' => ['web', 'auth', 'admin']], function () {
    
    // Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // User
    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
    Route::get('/user-create-page', [App\Http\Controllers\Admin\UserController::class, 'createPage'])->name('admin.user-create-page');
    Route::post('/user-create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.user-create');
    Route::get('/user-update-page/{id}', [App\Http\Controllers\Admin\UserController::class, 'updatePage'])->name('admin.user-update-page');
    Route::post('/user-update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user-update');
    Route::post('/user-delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.user-delete');
    
    //Agenda
    Route::get('/agenda', 'Admin\AgendaController@index')->name('admin.agenda');
    Route::get('/agenda-create-page', 'Admin\AgendaController@createPage')->name('admin.agenda-create-page');
    Route::get('/agenda-detail/{id}', 'Admin\AgendaController@detail')->name('admin.agenda-detail');
    Route::get('/agenda-update-page/{id}', 'Admin\AgendaController@updatePage')->name('admin.agenda-update-page');
    
    //CRUD Agenda
    Route::post('/agenda-create', 'Admin\AgendaController@create')->name('admin.agenda-create');
    Route::post('/agenda-update/{id}', 'Admin\AgendaController@update')->name('admin.agenda-update');
    Route::post('/agenda-delete/{id}', 'Admin\AgendaController@delete')->name('admin.agenda-delete');
    
    //Pembayaran
    Route::get('/pembayaran', 'Admin\PembayaranController@index')->name('admin.pembayaran');
    Route::get('/pembayaran-create-page', 'Admin\PembayaranController@createPage')->name('admin.pembayaran-create-page');
    Route::get('/pembayaran-detail/{id}', 'Admin\PembayaranController@detail')->name('admin.pembayaran-detail');
    
    //CRUD Pembayaran
    Route::post('/pembayaran-create', 'Admin\PembayaranController@create')->name('admin.pembayaran-create');
    Route::post('/pembayaran-delete/{id}', 'Admin\PembayaranController@delete')->name('admin.pembayaran-delete');
    Route::post('/pembayaran-update-status/{id}', 'Admin\PembayaranController@updateStatus')->name('admin.pembayaran-update-status');
    
    //Guru
    Route::get('/guru', 'Admin\GuruController@index')->name('admin.guru');
    Route::get('/guru-create-page', 'Admin\GuruController@createPage')->name('admin.guru-create-page');
    Route::get('/guru-detail/{id}', 'Admin\GuruController@detail')->name('admin.guru-detail');
    Route::get('/guru-delete/{id}', 'Admin\GuruController@delete')->name('admin.guru-delete');
    
    //Murid
    Route::get('/murid', 'Admin\MuridController@index')->name('admin.murid');
    Route::get('/murid-create-page', 'Admin\MuridController@createPage')->name('admin.murid-create-page');
    Route::get('/murid-detail/{id}', 'Admin\MuridController@detail')->name('admin.murid-detail');
    Route::post('/murid-delete/{id}', 'Admin\MuridController@delete')->name('admin.murid-delete');
    
    //Presensi
    Route::get('/presensi', 'Admin\PresensiController@index')->name('admin.presensi');
    Route::get('/data-presensi', 'Admin\PresensiController@dataPresensi')->name('admin.data-presensi');
    Route::get('/presensi-create-page', 'Admin\PresensiController@createPage')->name('admin.presensi-create-page');
    Route::post('/presensi-create', 'Admin\PresensiController@create')->name('admin.presensi-create');
    Route::get('/presensi-detail/{id}', 'Admin\PresensiController@detail')->name('admin.presensi-detail');
    Route::post('/presensi-delete/{id}', 'Admin\PresensiController@delete')->name('admin.presensi-delete');
    
    //Export Murid
    Route::post('/export-hafalan/{id}', 'Admin\MuridController@exportHafalan')->name('admin.export-hafalan');
    Route::post('/export-pencatatan/{id}', 'Admin\MuridController@exportPencatatan')->name('admin.export-pencatatan');
    Route::post('/export-presensi/{id}', 'Admin\PresensiController@export')->name('admin.export-presensi');
    Route::post('/export-pembayaran', 'Admin\PembayaranController@export')->name('admin.export-pembayaran');
    Route::post('/export-mengajar/{id}', 'Admin\GuruController@exportMengajar')->name('admin.export-mengajar');
    
});

Auth::routes(['verify' => true]);
