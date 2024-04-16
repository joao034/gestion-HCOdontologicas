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
use App\Services\PresupuestoService;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PresupuestoController extends Controller
{

    public function pdf($presupuesto_id)
    {
        $presupuestoService = new PresupuestoService();

        $presupuesto = Odontograma::find($presupuesto_id);
        $hClinica = HistoriaClinica::find($presupuesto->hclinica_id);
        $paciente = Paciente::find($hClinica->paciente_id);
        $detalles_presupuesto = $presupuestoService->getDetallesPresupuesto($presupuesto_id);
        $total_abonado = $presupuestoService->getTotalAbonado($presupuesto_id);
        $total_realizado = $presupuestoService->getTotalRealizado($presupuesto_id);
        $pdf = Pdf::loadView('presupuestos.pdf', compact('paciente', 'presupuesto', 'detalles_presupuesto', 'total_abonado', 'total_realizado'));
        return $pdf->stream('presupuesto_' . $paciente->nombreCompleto() . '.pdf');
    }

  
    public function show(int $hclinica_id) {}

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

            return back()->with('message', 'Tratamiento agregado al presupuesto.');
        } catch (Exception $e) {
            return back()->with('danger', 'No se agregó el tratamiento al presupuesto.' . $e->getMessage());
        }
    }

    public function edit(int $hclinica_id)
    {
        $presupuestoService = new PresupuestoService();

        $hClinica = HistoriaClinica::find($hclinica_id);
        $presupuesto = $hClinica->odontograma->first();
        $detalles_presupuesto = $presupuestoService->getDetallesPresupuesto($presupuesto->id);
        $tratamientos = Tratamiento::orderBy('nombre', 'asc')->get();
        $total_abonado = $presupuestoService->getTotalAbonado($presupuesto->id);
        $total_realizado = $presupuestoService->getTotalRealizado($presupuesto->id);
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
