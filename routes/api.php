<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AppController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('app')->group(function () {
    Route::post('/login',[UserController::class,'login']);
    Route::post('/register',[UserController::class,'register']);
    Route::middleware('jwt')->group(function(){
        Route::get('category',[AppController::class,'category']);
        Route::get('sub-category/{category_id}',[AppController::class,'subCategoryWithItems']);
        Route::get('items/{sub_category_id}',[AppController::class,'ItemsBySubCategory']);

    });

});
