<?php

use App\Http\Controllers\EspecialidadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HClinicaController;
use App\Http\Controllers\OdontologoController;
use App\Http\Controllers\TratamientoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

//idioma
Route::get('/greeting/{locale}', function (string $locale) {
    if (! in_array($locale, ['es',])) {
        abort(400);
    }
 
    App::setLocale($locale);
 
    // ...
});

Route::get('/inicio', function () {
    return view('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource("hclinicas", HClinicaController::class);
Route::resource("tratamientos", TratamientoController::class);
Route::resource("especialidades", EspecialidadController::class);
Route::resource("odontologos", OdontologoController::class);