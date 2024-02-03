<?php

use App\Http\Controllers\EspecialidadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HClinicaController;
use App\Http\Controllers\OdontogramaController;
use App\Http\Controllers\OdontogramaDetalleController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\PacientesPorOdontologoController;
use App\Http\Controllers\PacientesPorTratamientoController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PresupuestoPorTiempoController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\TopPacientesPorPresupuesto;
use App\Http\Controllers\AbonoController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\ExamenComplementarioController;
use App\Http\Controllers\ConsultaController;

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

    Route::resource("hclinicas", HClinicaController::class);

    Route::resource("tratamientos", TratamientoController::class);
    Route::resource("especialidades", EspecialidadController::class);
    //Route::resource("odontologos", OdontologoController::class);
    Route::resource("consultas", ConsultaController::class);
    Route::resource("odontogramas", OdontogramaController::class);

    Route::put('odontogramas/update-cpo/{id}', [OdontogramaController::class, 'updateCpo'])->name('update.cpo');
    Route::put('odontogramas/update-indicador_salud_bucal/{id}', [OdontogramaController::class, 'update_indicador_salud_bucal'])->name('update.indicador_salud_bucal');

    Route::resource("detalleOdontogramas", OdontogramaDetalleController::class);
    Route::resource("presupuestos", PresupuestoController::class);
    Route::resource("users", UserController::class);
    Route::resource("abonos", AbonoController::class);
    Route::resource("diagnosticos", DiagnosticoController::class);
    Route::resource("examenesComplementarios", ExamenComplementarioController::class);

    Route::post('odontogramas/nuevo/{paciente_id}', 'App\Http\Controllers\OdontogramaController@nuevo')->name('odontogramas.nuevo');

    Route::put('presupuestos/update-precio/{id_detalle_presupuesto}', [PresupuestoController::class, 'updatePrecio'])->name('update.precio');

    Route::match(['post', 'put', 'patch'], '/asignar-odontologo/', [OdontogramaDetalleController::class, 'asignar_tratamientos_a_odontologo'])->name('asignar.odontologo');

    Route::post('presupuestos/store-abono/{id_detalle_presupuesto}', [PresupuestoController::class, 'storeAbono'])->name('store.abono');

    Route::get('reportes/pacientes-por-odontologo', [PacientesPorOdontologoController::class, 'get_pacientes_por_odontologo'])->name('reportes.get_pacientes_por_odontologo');

    Route::get('reportes/pacientes-por-tratamiento', [PacientesPorTratamientoController::class, 'get_pacientes_por_tratamiento'])->name('reportes.get_pacientes_por_tratamiento');

    Route::get('reportes/pdf/pacientes-por-odontologo', [PacientesPorOdontologoController::class, 'generate_pdf'])->name('reportes.pacientes-por-odontologo.pdf');

    Route::get('reportes/pdf/pacientes-por-tratamiento', [PacientesPorTratamientoController::class, 'generate_pdf'])->name('reportes.pacientes-por-tratamiento.pdf');
    
    Route::get('reportes/total-presupuesto-por-meses', [PresupuestoPorTiempoController::class, 'get_total_presupuestos_y_abonos_por_meses'])->name('reportes.total-presupuesto-por-meses');

    Route::get('reportes/top-pacientes-por-presupuesto', [TopPacientesPorPresupuesto::class, 'get_top_3_pacientes_por_total_presupuesto'])->name('reportes.top_pacientes_por_presupuesto');
    
    Route::get('enviar-mensaje/{presupusto_id}', [SMSController::class, 'send_sms'])->name('presupuestos.enviar-mensaje');

    Route::get('enviar-hclinica/{odontograma_id}', [SMSController::class, 'send_hclinica_sms'])->name('odontogramas.enviar-mensaje');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('presupuestos/pdf/{odontograma_cabecera_id}', [PresupuestoController::class, 'pdf'])->name('presupuestos.pdf');

Route::get('odontogramas/pdf/{odontograma_cabecera_id}', [OdontogramaController::class, 'pdf'])->name('odontogramas.pdf');
