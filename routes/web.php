<?php

use App\Http\Controllers\EspecialidadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HClinicaController;
use App\Http\Controllers\OdontogramaController;
use App\Http\Controllers\OdontogramaDetalleController;
use App\Http\Controllers\OdontologoController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\PacientesPorOdontologoController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\App;

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


Route::redirect('/', 'login');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('presupuestos/pdf/{odontograma_cabecera_id}', [PresupuestoController::class, 'pdf'])->name('presupuestos.pdf');

    Route::resource("hclinicas", HClinicaController::class);

    Route::resource("tratamientos", TratamientoController::class);
    Route::resource("especialidades", EspecialidadController::class);
    //Route::resource("odontologos", OdontologoController::class);
    Route::resource("odontogramas", OdontogramaController::class);
    Route::resource("detalleOdontogramas", OdontogramaDetalleController::class);
    Route::resource("presupuestos", PresupuestoController::class);
    Route::resource("users", UserController::class);
    Route::post('odontogramas/nuevo/{paciente_id}', 'App\Http\Controllers\OdontogramaController@nuevo')->name('odontogramas.nuevo');

    Route::put('presupuestos/update-precio/{id_detalle_presupuesto}', [PresupuestoController::class, 'updatePrecio'])->name('update.precio');

    Route::put('presupuestos/update-estado/{id_detalle_presupuesto}', [PresupuestoController::class, 'updateEstado'])->name('update.estado');

    Route::get('reportes/pacientes-por-odontologo', [PacientesPorOdontologoController::class, 'get_pacientes_por_odontologo'])->name('reportes.get_pacientes_por_odontologo');

    Route::get('reportes/pdf/pacientes-por-odontologo', [PacientesPorOdontologoController::class, 'generate_pdf'])->name('reportes.pacientes-por-odontologo.pdf');
    
    /* Route::get('total-presupuesto', [ReportController::class, 'get_total_por_rango_de_fechas'])->name('total-presupuesto'); */
 
    Route::get('enviar-mensaje/{presupusto_id}', [WhatsappController::class, 'sendMessage'])->name('presupuestos.enviar-mensaje');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
