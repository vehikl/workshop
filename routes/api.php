<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name('auth.me');

Route::post('/login', function (Request $request) {

    if (auth()->attempt($request->all())) {
        $tokenName = 'todo-list-authentication';
        $token = $request->user()->createToken($tokenName);

        return ['token' => $token->plainTextToken];
    }

    return [];
})->name('auth.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('todo-list-items', \App\Http\Controllers\TodoListItemController::class)
        ->only('index', 'store');
});
