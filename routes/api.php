<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\IngredientController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::get('/image/{path}', [ImageController::class,'getImage']);

Route::middleware([AllowHeadersMiddleware::class, SessionHandler::class])->group(function () {
    Route::get('/auth/logged', [SessionController::class, 'isLogged']);
    Route::get('/auth/admin', [SessionController::class, 'createAdmin']);
    Route::get('/auth/logout', [SessionController::class, 'logout']);
    Route::post('/auth/login', [SessionController::class, 'login']);
    Route::post('/auth/register', [SessionController::class, 'register']);

    Route::get('/post/all', [PostController::class, 'getAllPosts']);
    Route::get('/post/vote/{id}/{liked}',[PostController::class, 'votePost']);
    Route::get('/post/get/{id}', [PostController::class, 'getPost']);
    Route::get('/post/like/{title}', [PostController::class, 'getPostsLike']);
    Route::get('/post/delete/{id}', [PostController::class, 'deletePost']);
    Route::get('/post/postedBy/{id}',[ChannelController::class, 'getPostedBy']);
    Route::get('/post/likedBy/{id}',[ChannelController::class, 'getLikedBy']);
    Route::post('/post/create/', [PostController::class, 'create']);
    
    Route::get('/post/deleteRange/{first}/{last}', [PostController::class, 'deletePostRange']);


    Route::get('/user/get/{id}', [UserController::class, 'getUser']);

    
    Route::get('/channels/all/',[ChannelController::class, 'getAllChannels']);
    Route::get('/channels/getPosts/{id}',[ChannelController::class, 'getChannelPosts']);
    Route::get('/channels/followedBy/{id}',[ChannelController::class, 'getFollowedBy']);
    Route::get('/channels/addPost/{channel}/{post}',[ChannelController::class,'addPostToChannel']);
    
    Route::get('/methods/all',[MethodController::class,'getAllMethods']);
    Route::get('/methods/like/{name}',[MethodController::class,'getMethodsLike']);

    Route::get('/ingredients/all/',[IngredientController::class,'getAllIngredients']);
    Route::get('/ingredients/like/{name}',[IngredientController::class,'getIngredientsLike']);

});

