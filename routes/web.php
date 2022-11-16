<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\API\ProgramController;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Middleware;

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
Route::resource('mahasiswa', mahasiswaController::class);
Route::resource('programs',
App\Http\Controllers\API\ProgramController::class);

Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('user', mahasiswaController::class);


Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['logincheck:admin']], function (){
        Route::resource('admin', AdminController::class);
    });
    Route::group(['middleware' => ['logincheck:editor']], function(){
        Route::resource('editor', EditorController::class);
    });
});