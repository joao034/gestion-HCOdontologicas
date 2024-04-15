<?php

namespace App\Http\Controllers;

use App\Events\DetallePresupuestoModificado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Odontograma;
use App\Models\OdontogramaDetalle;
use App\Models\Odontologo;
use App\Models\Simbolo;
use App\Models\Tratamiento;
use App\Models\Paciente;
use App\Models\Abono;
use App\Models\HistoriaClinica;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PresupuestoController extends Controller
{

    public function pdf($presupuesto_id)
    {
        $presupuesto = Odontograma::find($presupuesto_id);
        $paciente = Paciente::find($presupuesto->paciente_id);
        $detalles_presupuesto = $this->getDetallesPresupuesto($presupuesto_id);
        $total_abonado = $this->getTotalAbonado($presupuesto_id);
        $total_realizado = $this->getTotalRealizado($presupuesto_id);
        $pdf = Pdf::loadView('presupuestos.pdf', compact('paciente', 'presupuesto', 'detalles_presupuesto', 'total_abonado', 'total_realizado'));
        return $pdf->stream('presupuesto_' . $paciente->nombres . ' ' . $paciente->apellidos . '.pdf');
    }

    public function show(int $paciente_id)
    {
        $paciente = Paciente::find($paciente_id);

        // Ordenar los presupuestos por fecha en orden descendente
        $presupuestos = $paciente->odontogramasCabecera()->latest('updated_at')->get();

        //si el paciente tiene mas de un presupuesto muestra la vista show
        if ($presupuestos->count() > 1) {
            return view('presupuestos.show', compact(['paciente', 'presupuestos']));
        }

        //Si tiene solo un presupuesto redirije directamente al unico presupuesto disponible
        return to_route('presupuestos.edit', $presupuestos->first()->id);
    }

    private function obtenerIdDelOdontologoEnSesion()
    {
        $odontologo = Odontologo::where('user_id', '=', auth()->user()->id)->first();
        return $odontologo->id;
    }

    private function esOdontologoElUsuarioEnSesion()
    {
        return Auth::user()->role == 'odontologo';
    }

    private function guardarOdontologId(Request $request)
    {
        return $this->esOdontologoElUsuarioEnSesion() ? $this->obtenerIdDelOdontologoEnSesion() : $request->odontologo_id;
    }

    //almacena los detalles del presupuesto
    public function store(Request $request)
    {
        try {
            $detalle_presupuesto = new OdontogramaDetalle();
            $detalle_presupuesto->odontograma_cabecera_id = $request->presupuesto_id;
            $detalle_presupuesto->tratamiento_id = $request->tratamiento_id;
            $detalle_presupuesto->num_pieza_dental = "-";
            $detalle_presupuesto->cara_dental = "-";
            $detalle_presupuesto->precio = Tratamiento::find($request->tratamiento_id)->precio;
            $detalle_presupuesto->odontologo_id = $this->guardarOdontologId($request);
            $detalle_presupuesto->estado = 'necesario';
            $detalle_presupuesto->save();

            DetallePresupuestoModificado::dispatch( $detalle_presupuesto, 'add' );
            return back()->with('message', 'Tratamiento agregado al presupuesto.');
        } catch (Exception $e) {
            return back()->with('danger', 'No se agregó el tratamiento al presupuesto.' . $e->getMessage());
        }
    }

    public function edit(int $hclinica_id)
    {
        $hClinica = HistoriaClinica::find($hclinica_id);
        $presupuesto = $hClinica->odontograma->first();
        $detalles_presupuesto = $this->getDetallesPresupuesto($presupuesto->id);
        $tratamientos = Tratamiento::orderBy('nombre', 'asc')->get();
        $total_abonado = $this->getTotalAbonado($presupuesto->id);
        $total_realizado = $this->getTotalRealizado($presupuesto->id);
        $detalles = OdontogramaDetalle::where('odontograma_cabecera_id', $presupuesto->id)->get();
        $abonos = Abono::whereIn('odontograma_detalle_id', $detalles->pluck('id'))->get();
        return view('presupuestos.detalle_presupuesto', compact('hClinica', 'detalles_presupuesto', 'presupuesto', 'tratamientos', 'total_abonado', 'total_realizado', 'abonos'));
    }

    //no se ocupa
    //actualiza el estado del detalle del presupuesto a fuera de presupuesto al momento de eliminarlo un detalle del presupuesto
    /* public function updateEstado(int $id)
    {
        try {
            $detalle_presupuesto = OdontogramaDetalle::find($id);
            $detalle_presupuesto->estado = 'fuera_presupuesto';

            //encontrar el presupuesto al que pertenece el detalle
            $presupuesto = Odontograma::find($detalle_presupuesto->odontograma_cabecera_id);
            $presupuesto->total = $presupuesto->total - $detalle_presupuesto->precio;

            $presupuesto->save();
            $detalle_presupuesto->save();
            return back()->with('message', 'Tratamiento eliminado del presupuesto.');
        } catch (\Exception $e) {
            return back()->with('danger', 'No se pudo eliminar el tratamiento del presupuesto.');
        }
    } */

    public function storeAbono(int $id, Request $request)
    {
        try {
            $request->validate([
                'monto' => 'required|numeric|min:1'
            ]);

            $detalle_presupuesto = OdontogramaDetalle::find($id);
            
            $esMontoValido = $this->esValidoElMonto($request->monto, $detalle_presupuesto);


            if (!$esMontoValido) {
                return back()->with('danger', 'Debe ingresar un monto menor o igual al saldo.');
            }

            $abono = new Abono();
            $abono->monto = $request->monto;
            $abono->odontograma_detalle_id = $detalle_presupuesto->id;
            $abono->save();
            return back()->with('message', 'Abono registrado correctamente.');
        } catch (Exception $e) {
            return back()->with('danger', 'No se pudo actualizar el presupuesto. ' . $e->getMessage());
        }
    }

    private function getTotalRealizado(int $presupuesto_id)
    {
        $detalles_presupuesto = $detalles_presupuesto = OdontogramaDetalle::query()
        ->where('odontograma_cabecera_id', '=', "$presupuesto_id")
        ->where('estado', '=', 'realizado')->get();
        $sumatorio = 0;
        foreach ($detalles_presupuesto as $detalle_presupuesto) {
            $sumatorio += $detalle_presupuesto->precio;
        }
        return $sumatorio;
    }


    private function getTotalAbonado(int $presupuesto_id)
    {
        $detalles_presupuesto = $this->getDetallesPresupuesto($presupuesto_id);
        $sumatorio = 0;
        foreach ($detalles_presupuesto as $detalle_presupuesto) {
            $sumatorio += $this->getTotalDeAbonosDeDetalle($detalle_presupuesto->id);
        }
        return $sumatorio;
    }

    //validar que el monto ingresado sea menor o igual al saldo
    private function esValidoElMonto(float $monto, OdontogramaDetalle $detalle_presupuesto)
    {
        $sumatoriaAbonos = $this->getTotalDeAbonosDeDetalle($detalle_presupuesto->id);
        $saldo = $detalle_presupuesto->precio - $sumatoriaAbonos;
        if ($monto > $saldo) {
            return false;
        }
        return true;
    }

    private function getDetallesPresupuesto(int $id)
    {
        /* $detalles_presupuesto = OdontogramaDetalle::query()
                                                ->where('odontograma_cabecera_id', '=', "$id")
                                                ->where( function( $query ) {
                                                    $query->where('estado', '=', 'necesario')
                                                    ->orWhere('estado', '=', 'presupuesto')
                                                    ->orWhere('estado', '=', 'realizado');
                                                })->get();  */
        $detalles_presupuesto = OdontogramaDetalle::query()
            ->where('odontograma_cabecera_id', '=', "$id")
            ->where('estado', '!=', 'hallazgo')
            ->orderByRaw("FIELD(estado , 'realizado', 'necesario')")
            ->get();

        $detalles_presupuesto->map(function ($detalle_presupuesto) {
            $detalle_presupuesto->abonos = $this->getTotalDeAbonosDeDetalle($detalle_presupuesto->id);
            return $detalle_presupuesto;
        });

        return $detalles_presupuesto;
    }

    private function getTotalDeAbonosDeDetalle(int $id_detalle)
    {
        $abonos = Abono::where('odontograma_detalle_id', '=', "$id_detalle")->get();
        $sumatorio = 0;
        foreach ($abonos as $abono) {
            $sumatorio += $abono->monto;
        }
        return $sumatorio;
    }

    //actualiza el precio de un detalle del presupuesto
    public function updatePrecio(int $id_detalle_presupuesto, Request $request)
    {
        //validar que el precio sea mayor a cero
        $request->validate([
            'precio' => 'required|numeric|min:1'
        ]);

        try {
            $detalle_presupuesto = OdontogramaDetalle::find($id_detalle_presupuesto);

            $dif_precio = $detalle_presupuesto->precio - $request->precio;

            $presupuesto = Odontograma::find($detalle_presupuesto->odontograma_cabecera_id);

            if ($request->precio > $detalle_presupuesto->precio) {
                $presupuesto->total = $presupuesto->total + ($dif_precio * (-1));
                $presupuesto->save();
            }

            if ($request->precio < $detalle_presupuesto->precio) {
                $presupuesto->total = $presupuesto->total - $dif_precio;
                $presupuesto->save();
            }

            $detalle_presupuesto->precio = $request->precio;
            $detalle_presupuesto->save();
            return back()->with('message', 'Precio actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo actualizar el precio');
        }
    }
}
