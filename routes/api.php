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
});
Route::post('/v1/login', 'App\Http\Controllers\AuthApiController@login')->middleware('web');

Route::post('/v1/register', 'App\Http\Controllers\Api\RegisterController@register')->middleware('web');

    Route::group(['namespace' => 'App\Http\Controllers\Api\v1\Admin'], function () {
        Route::apiResource('/v1/users', 'ManageUserController');
        Route::apiResource('/v1/roles', 'RoleController');
        Route::apiResource('/v1/permissions', 'PermissionController');
        Route::apiResource('/v1/products', 'ProductController');
        Route::apiResource('/v1/suppliers', 'SupplierController');
        Route::get('/v1/categories/{category:name}/products', 'CategoryController@getProductByname');
        Route::apiResource('/v1/categories', 'CategoryController');
        Route::get('v1/categories/{id}/products' , 'CategoryController@getProductByCategory');
    })->middleware('auth:sanctum');
Route::post('/v1/logout', 'App\Http\Controllers\AuthApiController@logout')->middleware('auth:sanctum');


