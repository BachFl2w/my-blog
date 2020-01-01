<?php

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

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

Route::group([
    'middleware' => ['json.response'],
    'namespace' => 'Api',
    'as' => 'api.',
], function () {
    // public routes
    Route::post('/login', 'AuthController@login')->name('login');
    Route::post('/register', 'AuthController@register')->name('register');

    Route::resource('posts', 'PostController')->only(['index', 'show']);

    // private routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::get('/logout', 'AuthController@logout')->name('logout');

        Route::resource('posts', 'PostController')->only(['store', 'update', 'destroy']);
    });
});
