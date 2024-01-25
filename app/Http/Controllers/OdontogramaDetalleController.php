<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Odontograma;
use App\Models\Odontologo;
use Illuminate\Http\Request;
use App\Models\Tratamiento;
use App\Models\OdontogramaDetalle;
use App\Models\Simbolo;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;

class OdontogramaDetalleController extends Controller
{

    public function __construct()
    {
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tratamiento_id' => ['required'],
            'cara_dental' => ['required'],
            'simbolo_id' => ['required'],
            'odontologo_id' => ['required'],
            'observacion' => ['nullable', 'string', 'max:255'],
        ], $this->messages());
    }

    protected function messages()
    {
        return [
            'tratamiento_id.required' => 'Seleccione un tratamiento.',
            'odontologo_id.required' => 'Seleccione un odontólogo.',
            'cara_dental.required' => 'Seleccione una cara dental.',
            'simbolo_id.required' => 'Seleccione un símbolo.',
            'observacion.max' => 'La observación no puede tener más de :max caracteres.',
        ];
    }

    private function mostrarErroresDeValidacion($request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function store(Request $request)
    {
        try {
            $this->mostrarErroresDeValidacion($request);
            $this->validator($request->all())->validate();
            $this->guardarDetalle($request);
            return back()->with('message', 'Detalle del odontograma agreagado correctamente.');
        } catch (\Exception $e) {
            return back()->with('danger', 'No se pudo guardar el detalle del odontograma.');
        }
    }

    public function show(int $id)
    {
        $odontograma = Odontograma::find($id);
        $tratamientos = Tratamiento::orderBy('nombre', 'asc')->get();
        $odontologos = $this->getOdontologosActivos();
        $necesario = 'necesario';
        $realizado = 'realizado';
        $simbolosRojos = Simbolo::getSimbolosPorTipo($necesario);
        $simbolosAzules = Simbolo::getSimbolosPorTipo($realizado);

        $colorRojo = '#dc3545';
        $colorAzul = '#3243a6';

        $simboloRojo = $simbolosRojos->where('color', $colorRojo)->first();
        $simboloAzul = $simbolosAzules->where('color', $colorAzul)->first();

        $detalles_odontograma = $this->getDetallesOdontograma($id);

        return view('odontogramas.edit', compact([
            'tratamientos', 'odontograma', 'detalles_odontograma',
            'odontologos', 'simbolosRojos', 'simbolosAzules', 'simboloRojo', 'simboloAzul'
        ]));
    }

    public function update(int $id, Request $request)
    {
        try {
            $request->validate([
                'estado' => 'required',
                'odontologo_id' => 'required',
                'tratamiento_id' => 'required',
                'observacion' => 'nullable|string|max:255',
            ]);

            $detalle_odontograma = OdontogramaDetalle::find($id);

            if ($request->estado === 'realizado') {
                $detalle_odontograma->fecha_realizado = Carbon::now();
                $this->actualizarDetalle($detalle_odontograma, $request);
            }

            if ($request->estado === 'necesario') {
                $detalle_odontograma->fecha_realizado = null;
                $this->actualizarDetalle($detalle_odontograma, $request);
            }
            return back()->with('message', 'Detalle del odontograma actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->with('danger', 'No se pudo actualizar el detalle del odontograma. Revise que el odontólogo esté activo.');
        }
    }

    private function guardarDetalle($request)
    {
        $detalle_odontograma = new OdontogramaDetalle();
        $this->asignarVariables($detalle_odontograma, $request);
        $detalle_odontograma->save();
    }

    private function asignarVariables(OdontogramaDetalle $detalle_odontograma, Request $request)
    {
        $detalle_odontograma->num_pieza_dental = $request->num_pieza_dental;
        $detalle_odontograma->cara_dental = $this->eliminarElementosRepetidos($request->cara_dental);
        if (isset($detalle_odontograma->cara_dental)) {
            $detalle_odontograma->cara_dental = is_array($detalle_odontograma->cara_dental) ? implode(",", $detalle_odontograma->cara_dental) : [];
        }
        $detalle_odontograma->simbolo_id = $request->simbolo_id;
        $detalle_odontograma->odontograma_cabecera_id = $request->odontograma_cabecera_id;
        $detalle_odontograma->tratamiento_id = $request->tratamiento_id;
        $detalle_odontograma->precio = Tratamiento::find($request->tratamiento_id)->precio;
        $detalle_odontograma->odontologo_id = $request->odontologo_id;
        $detalle_odontograma->observacion = $request->observacion;

        //consultar el tipo del simbolo
        $simbolo = Simbolo::find($request->simbolo_id);
        //almacena el tipo del simbolo dependiendo si es realizado o necesario
        $detalle_odontograma->estado = $simbolo->tipo === 'realizado' ? 'hallazgo' : 'necesario';
    }

    private function actualizarDetalle($detalle_odontograma, Request $request)
    {
        $detalle_odontograma->estado = $request->estado;
        $nombreSimbolo = explode(" ", $detalle_odontograma->simbolo->nombre);
        $nombreSimbolo = $nombreSimbolo[0];

        $simbolo = $this->buscarSimboloPorTipo($nombreSimbolo, $detalle_odontograma->estado);

        //almacena el tipo del simbolo dependiendo si es realizado o necesario
        $detalle_odontograma->simbolo_id = $simbolo->id;
        $detalle_odontograma->odontologo_id = $request->odontologo_id;
        $detalle_odontograma->observacion = $request->observacion;
        $detalle_odontograma->save();
    }

    private function buscarSimboloPorTipo($nombreSimbolo, $tipo)
    {
        return Simbolo::where('nombre', 'like', '%' . $nombreSimbolo . '%')
            ->where('tipo', '=', $tipo)
            ->first();
    }

    public function destroy(int $id)
    {
        try {
            $detalle_odontograma = OdontogramaDetalle::find($id);
            $detalle_odontograma->delete();
            return back()->with('message', 'Detalle del odontograma eliminado correctamente.');
        } catch (\Exception $e) {
            return back()->with('danger', 'No se pudo eliminar el detalle del odontograma.');
        }
    }

    private function getDetallesOdontograma(int $odontograma_cabecera_id)
    {
        $detalles_odontograma = OdontogramaDetalle::query()
            ->where('odontograma_cabecera_id', '=', "$odontograma_cabecera_id")
            /* ->where(function ($query) {
                $query->where('estado', '=', 'necesario')
                    ->orWhere('estado', '=', 'realizado')
                    ->orWhere('estado', '=', 'fuera_presupuesto');
            }) */
            //ordenar primero los necesarios
            ->orderByRaw("FIELD(estado , 'necesario', 'realizado', 'hallazgo')")
            ->paginate(10);

        return $detalles_odontograma;
    }

    private function eliminarElementosRepetidos($array)
    {
        return array_unique($array);
    }

    //obtener usuarios tipo odontologos que esten activos
    private function getOdontologosActivos()
    {
        return User::where('role', '=', 'odontologo')
            ->where('active', '=', 1)
            ->get();
    }
}
