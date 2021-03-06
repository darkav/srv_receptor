<?php

use App\Http\Controllers\ApiSucursalController;
use App\Http\Controllers\ApiCategoriaController;
use App\Http\Controllers\ReceivedController;
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

// sucursal
Route::get('/sucursal/v1',[ApiSucursalController::class,'index']);
Route::get('/sucursal/v1/{id}',[ApiSucursalController::class,'show']);
// catagoria
Route::get('/categoria/v1',[ApiCategoriaController::class,'index']);
Route::get('/categoria/v1/ally',[ApiCategoriaController::class,'ally']);
Route::get('/categoria/v1/{id}',[ApiCategoriaController::class,'show']);
Route::get('/categoria/v1/{id}/tablas',[ApiCategoriaController::class,'listarTablas']);
// receive
Route::get('/received/v1/created/{tabla}',[ReceivedController::class,'CreateTable']);
Route::get('/received/v1/exists/{tabla}',[ReceivedController::class,'ExistTable']);
Route::get('/received/v1/droped/{tabla}',[ReceivedController::class,'DropTable']);
Route::get('/received/v1/registros/{categoria}/{local}',[ReceivedController::class,'AllRecordTable']);
Route::get('/received/v1/{categoria}/{local}/{tabla}',[ReceivedController::class,'MaxRegistro']);
Route::post('/received/v1/',[ReceivedController::class,'InsertTable']);
Route::put('/received/v1/',[ReceivedController::class,'UpdateTable']);