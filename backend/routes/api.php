<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\SourceController;
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

require __DIR__.'/auth.php';

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(UserController::class)->group(function(){
        Route::get('/user', 'getUser');
    });

    Route::controller(PreferenceController::class)->group(function () {
        Route::post('/add-to-preference', 'addToPreference');
    });

    Route::controller(PreferenceController::class)->group(function(){
        Route::get('/get-preference', 'getUserPreference');
    });

});


Route::controller(ArticleController::class)->group(function () {
    Route::match(['get', 'post'], '/filter', 'fetchNews');
});

Route::controller(SourceController::class)->group(function(){
    Route::get('/source-name', 'getSourceName');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/category-name', 'getCategoryName');
});

