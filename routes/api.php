<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\AuthController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/adalah', [AuthController::class, 'adalah']);
});



Route::group(['middleware' => 'api'], function ($router) {
    Route::post('/tambah_product',[ProductController::class,'store']);
    Route::put('/update_product',[ProductController::class,'updateNoParams']);
    Route::delete('/delete_product',[ProductController::class,'destroyNoParams']);
});


//dengan note routes di comment
//route single
Route::post('/tambah_product',[ProductController::class,'store']);

Route::get('/data_product',[ProductController::class,'index']);

Route::put('/update_product',[ProductController::class,'updateNoParams']);

Route::delete('/delete_product',[ProductController::class,'destroyNoParams']);
//route bundle
Route::resource('/product',ProductController::class);