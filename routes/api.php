<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoControllerApi;

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


Route::get('/todo',[TodoControllerApi::class,'index']);
Route::post('/todos/store', [TodoControllerApi::class, 'store']);
Route::post('/todos/update', [TodoControllerApi::class, 'update']);

Route::post('/todos/delete', [TodoControllerApi::class, 'delete']);
Route::post('/todos/filter', [TodoControllerApi::class, 'filter']);

require __DIR__.'/auth.php';
