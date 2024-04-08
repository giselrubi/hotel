<?php

use App\Http\Controllers\Api\TypesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function PHPSTORM_META\types;

use App\Http\Controllers\Api\CustomersController;
use function PHPSTORM_META\customers;

use App\Http\Controllers\Api\PlacesController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\ReservationsController;

use function PHPSTORM_META\places;

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
Route::post('/login',[AuthController::class, 'login']);


Route::get('/types',[TypesController::class, 'list']);
Route::get('/types/{id}',[TypesController::class, 'getByid']);
Route::post('/types/create', [typesController::class, 'create']);
Route::post('/types/update', [typesController::class, 'update']);

Route::get('/customers',[CustomersController::class, 'list']);
Route::get('/customers/{id}',[CustomersController::class, 'getByid']);
Route::post('/customers/create', [typesController::class, 'create']);
Route::post('/customers/update',[CustomersController::class, 'update']);

Route::get('/pleaces',[PlacesController::class, 'list']);
Route::get('/pleaces/{id}',[TypesController::class, 'getByid']);
Route::post('/pleaces/create',[PlacesController::class, 'create']);
Route::post('/pleaces/update', [typesController::class, 'update']);




Route::resource('/reservations',ReservationsController::class);


