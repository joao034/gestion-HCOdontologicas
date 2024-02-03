<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Odontograma;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\OdontogramaDetalle;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\IndiceCPO;
use App\Models\IndicadorSaludBucal;

class OdontogramaController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        /* $search = trim( $request->get('search') );
        $pacientes = Paciente::getAllPacientesWithPagination( $search, 'updated_at', 'desc' );
        return view('odontogramas.index', compact(['search', 'pacientes'])); */
    }

    public function pdf(int $odontograma_cabecera_id)
    {
        $odontograma = Odontograma::find($odontograma_cabecera_id);
        $paciente = $odontograma->paciente;
        $odontograma_detalles = $this->getDetallesOdontograma($odontograma_cabecera_id);
        $pdf = PDF::loadView('odontogramas.pdf', compact(['odontograma', 'paciente', 'odontograma_detalles']));
        return $pdf->stream('hclinica_' . $paciente->nombres . ' ' . $paciente->apellidos . '.pdf');
    }

    public function updateCpo(Request $request, int $odontograma_cabecera_id)
    {
        try {
            $odontograma = Odontograma::find($odontograma_cabecera_id);
            $odontograma->indice_cpo_cpe != null ?  $indice_cpo = $odontograma->indice_cpo_cpe : $indice_cpo = new IndiceCPO();
            $indice_cpo->odontograma_id = $odontograma->id;
            $indice_cpo->tipo = $request->tipo;
            $indice_cpo->caries = $request->caries;
            $indice_cpo->perdidas = $request->perdidas;
            $indice_cpo->obturadas = $request->obturadas;
            $indice_cpo->save();
            return back()->with('message', 'CPO actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('danger', 'No se pudo actualizar el CPO' . $e->getMessage());
        }
    }

    public function update_indicador_salud_bucal(Request $request, int $odontograma_cabecera_id)
    {
        try {
            $odontograma = Odontograma::find($odontograma_cabecera_id);
            $indicador_salud = $odontograma->indicadores_salud != null ? $odontograma->indicadores_salud : new IndicadorSaludBucal();
            $indicador_salud->odontograma_id = $odontograma->id;
            $indicador_salud->enfermedad_periodontal = $request->enfermedad_periodontal;
            $indicador_salud->tipo_oclusion = $request->tipo_oclusion;
            $indicador_salud->nivel_fluorosis = $request->nivel_fluorosis;
            $indicador_salud->save();
            return back()->with('message', 'Indicador de salud bucal actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('danger', 'No se pudo actualizar el indicador de salud bucal' . $e->getMessage());
        }
    }

    public function nuevo(int $paciente_id)
    {
        try {
            $odontograma = new Odontograma();
            $odontograma->fecha_creacion = Carbon::now();
            $odontograma->paciente_id = $paciente_id;
            $odontograma->total = 0;
            $odontograma->save();
            return to_route('detalleOdontogramas.show', $odontograma->id)->with('message', 'Odontograma creado correctamente');
        } catch (\Exception $e) {
            return back()->with('danger', 'No se pudo crear el nuevo odontograma. ');
        }
    }

    //muestra la lista de los odontogramas de un paciente
    public function show(int $paciente_id)
    {
        $paciente = Paciente::find($paciente_id);

        // Ordenar los odontogramas por fecha en orden descendente
        $odontogramas = $paciente->odontogramasCabecera()->latest('updated_at')->get();

        //si el paciente tiene mas de un odontograma muestra la vista show
        if ($odontogramas->count() > 1) {
            return view('odontogramas.show', compact(['paciente', 'odontogramas']));
        }

        //Si tiene solo un odontograma redirije directamente al unico odontograma disponible
        return to_route('detalleOdontogramas.show', $odontogramas->first()->id);
    }

    public function destroy(int $id)
    {
        try {
            $odontograma = Odontograma::find($id);
            //solo elimina si tiene el paciente tiene mas de un odontograma
            if ($odontograma->getNumeroDeOdontogramasDeUnPaciente($odontograma->paciente_id) > 1) {
                //elimina los detalles del odontograma
                OdontogramaDetalle::where('odontograma_cabecera_id', $id)->delete();
                $odontograma->delete();
                return to_route('odontogramas.index')->with('message', 'Odontograma eliminado correctamente');
            }
            return to_route('odontogramas.index')->with('danger', 'No se puede eliminar el odontograma del paciente, porque solo tiene un odontograma registrado');
        } catch (\Exception $e) {
            return to_route('odontogramas.index')->with('danger', 'Error al eliminar el odontograma');
        }
    }

    private function getDetallesOdontograma(int $odontograma_cabecera_id)
    {
        return OdontogramaDetalle::query()
            ->where('odontograma_cabecera_id', '=', "$odontograma_cabecera_id")
            ->get();
    }
}
