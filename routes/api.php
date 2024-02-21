<?php

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

Route::apiResource('carcategory', 'App\Http\Controllers\api\CarCategoryController')->except([
    'create', 'edit'
]);

Route::Resource('car', 'App\Http\Controllers\api\CarController');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
