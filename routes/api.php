<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserHandsetController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('users',[UserController::class, 'index']);
Route::post('user',[UserController::class, 'create']);
Route::delete('users/{id}',[UserController::class, 'delete']);

Route::get('usersandhandsets',[UserHandsetController::class , 'index']);
 //Route::get('users', 'UserController@index');
//Route::get('/users', [UserController::class, 'index'])->name('users');