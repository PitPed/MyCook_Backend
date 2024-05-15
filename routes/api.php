<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\AllowHeadersMiddleware;
use App\Http\Middleware\SessionHandler;


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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('/health', function(Request $request){return response()->json(['message'=>'ok'], 200);});


Route::middleware([AllowHeadersMiddleware::class, SessionHandler::class])->group(function () {
    Route::get('/auth/logged', [SessionController::class, 'isLogged']);
    Route::get('/auth/admin', [SessionController::class, 'createAdmin']);
    Route::get('/auth/logout', [SessionController::class, 'logout']);
    Route::post('/auth/login', [SessionController::class, 'login']);
    Route::post('/auth/register', [SessionController::class, 'register']);

    Route::get('/post/all', [PostController::class, 'getAllPosts']);
    Route::get('/post/get/{id}', [PostController::class, 'getPost']);
    Route::post('/post/create/', [PostController::class, 'create']);
});

