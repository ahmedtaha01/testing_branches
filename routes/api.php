<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\PostController;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/user/{id}', function ($id) {
    return User::find($id);
    // return new UserCollection(User::all());
});

Route::post('register',[RegisterController::class,'register']);


Route::apiResource('posts',PostController::class)->middleware('auth:sanctum');

Route::get('/welcome',function (){
    return "orders branch";
});