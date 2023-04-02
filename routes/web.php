<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\PruebaController;
use App\Http\Livewire\CatalogoHorasComponent;
use App\Http\Livewire\ChartComponent;
use App\Http\Livewire\RegistroHoraComponent;
use App\Http\Livewire\ReporteComponent;
use App\Http\Livewire\RoleComponent;
use App\Http\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('informacion', [App\Http\Controllers\PruebaController::class, 'prueba']);
//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', ChartComponent::class)->name('home');
Route::group(['middleware' => 'auth'], function () {

    Route::get('catalogos', CatalogoHorasComponent::class)->name('catalogos');
    Route::get('roles', RoleComponent::class)->name('roles');
    Route::get('user', UserComponent::class)->name('users');
    Route::get('registro-horas', RegistroHoraComponent::class)->name('registroHoras');
    Route::get('reportes', ReporteComponent::class)->name('reportes');
    Route::get('report/excel/{user}/{type}',[ExportController::class, 'reporteExcel']);
});
Auth::routes();

