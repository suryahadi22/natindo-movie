<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

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

Route::get('/', [AppController::class, 'index']);
Route::get('/list_contents', [AppController::class, 'list_contents']);

Route::post('/ajax_new', [AppController::class, 'ajax_new']);
Route::get('/modal_edit', [AppController::class, 'modal_edit']);
Route::post('/ajax_edit', [AppController::class, 'ajax_edit']);
Route::get('/ajax_delete', [AppController::class, 'ajax_delete']);
