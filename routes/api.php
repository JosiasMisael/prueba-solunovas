<?php

use App\Http\Controllers\ApiController;
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

Route::get('/horas-mes', [ApiController::class,'horasPorEmpleado']);
Route::get('/total-horas-empleado', [ApiController::class,'totalHorasEmpleado']);
Route::get('/horas-rango', [ApiController::class,'HorasRango']);
Route::get('/tareas-usuarios', [ApiController::class,'tareasUsuarios']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
