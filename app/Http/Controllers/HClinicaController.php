<?php

namespace App\Http\Controllers;

use App\Events\NuevoPacienteEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\AntecedentesInfeccioso;
use App\Models\AntecedentesPersonalesFamiliare;
use App\Models\Paciente;
use App\Models\Odontograma;
use App\Models\OdontogramaDetalle;
use App\Models\Representante;
use App\Models\Diagnostico;
use App\Models\TipoDocumento;
use App\Models\TipoNacionalidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\HistoriaClinica;

class HClinicaController extends Controller
{ 
    protected function validator(array $data)
    {
        $rules = [
            //foreign keys
            'tipo_documento_id' => ['required', 'integer'],
            'tipo_nacionalidad_id' => ['required', 'integer'],
            //datos del paciente
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cedula' => ['nullable', 'string', 'min:6', 'max:16'], //cedula hace referencia al nro del documento
            'estado_civil' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'ocupacion' => ['required', 'string', 'max:255'],
            'sexo' => ['required', 'string', 'max:255'],
            'celular' => ['nullable', 'min:10', 'max:10'],
            'telef_convencional' => ['nullable', 'min:6', 'max:9'],
            'fecha_nacimiento' => ['required', 'date', 'before:today', 'after:1900-01-01'],
        ];

        //si es mayor o igual a 18 y su tipo de documento es cedula el campo cedula es obligatorio
        if (isset($data['fecha_nacimiento']) && !empty($data['fecha_nacimiento']) && $data['tipo_documento_id'] == 1) {
            $fecha_nacimiento = date_create($data['fecha_nacimiento']);
            $hoy = date_create(date('Y-m-d'));
            $edad = date_diff($fecha_nacimiento, $hoy);
            if ($edad->y >= 18) {
                $rules['cedula'] = ['required', 'string', 'min:10', 'max:10', 'validar_cedula'];
            }
        }

        //si el paciente es menor o igual a 12 años el campo representante y cedula_representante son obligatorios
        if (isset($data['fecha_nacimiento']) && !empty($data['fecha_nacimiento'])) {
            $fecha_nacimiento = date_create($data['fecha_nacimiento']);
            $hoy = date_create(date('Y-m-d'));
            $edad = date_diff($fecha_nacimiento, $hoy);
            if ($edad->y < 12) {
                $rules['representante'] = ['required', 'string', 'max:100'];
                $rules['cedula_representante'] = ['required', 'string', 'min:10', 'max:10'];
            }
        }
        return Validator::make($data, $rules);
    }

    public function update_profesional_responsable(Request $request, int $paciente_id){
        try {
            $paciente = Paciente::find($paciente_id);
            $hclinica = count($paciente->historias_clinicas) == 1 ? $paciente->historias_clinicas->first() : new HistoriaClinica();
            $hclinica->paciente_id = $paciente->id;
            $hclinica->odontologo_id = $request->odontologo_id;
            $hclinica->save();
            return back()->with('message', 'Profesional responsable actualizado correctamente');
        } catch (\Exception $e) {
            return back()->with('danger', 'No se pudo actualizar el profesional responsable. ' . $e->getMessage());
        }
    }

    private function mostrarErroresDeValidacion($request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
    }

    public function index(Request $request)
    {
        $search = trim($request->get('buscador'));
        $pacientes = Paciente::getAllPacientesWithPaginationDB($search, 'apellidos', 'asc');
        return view('hclinicas.index', compact(['pacientes', 'search']));
    }

    public function create()
    {
        $tipos_documento = TipoDocumento::orderBy('nombre', 'asc')->get();
        $tipos_nacionalidad = TipoNacionalidad::all();
        return view("hclinicas.create", compact(['tipos_documento', 'tipos_nacionalidad']));
    }

    public function store(UserRequest $request)
    {
        try {
            dd($request->validated());
            //dd($request->all());
            DB::beginTransaction();
            $paciente = new Paciente();
            //validar los datos
            $this->mostrarErroresDeValidacion($request);
            $this->validator($request->all())->validate();
            if (!$this->verificarCedulaDistinta($request)) {
                return to_route('hclinicas.create')->with('danger', 'La cédula del representante no puede ser igual a la del paciente.');
            }

            $this->guardarOActualizarPaciente($paciente, $request);
            //insertar datos otras tablas
            $this->almacenarRepresentante($request, $paciente->id);

            NuevoPacienteEvent::dispatch($paciente);
            //$this->guardarActualizarConsulta($request, $paciente);
            //$this->guardarActualizarAntecedentePatologico($request, $paciente);
            //$this->almacenarAntecedentePersonales($request, $paciente->id);
            //$this->almacenarDiagnostico($request, $paciente->id);
            DB::commit();

            return to_route('consultas.edit', $paciente->id)->with('message', 'Paciente creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return to_route('hclinicas.create')->with('danger', 'No se pudo crear la Historia Clinica.' . $e->getMessage());
            throw $e;
        }
    }

    public function show(int $id)
    {
        try {
            $paciente = Paciente::getPacienteFormateado($id);
            $representante = Representante::where('paciente_id', $paciente->id)->first();
            $antPersonales = AntecedentesPersonalesFamiliare::where('paciente_id', $paciente->id)->first();
            $diagnostico = Diagnostico::where('paciente_id', $paciente->id)->first();
            $tipos_documento = TipoDocumento::orderBy('nombre', 'asc')->get();
            $tipos_nacionalidad = TipoNacionalidad::all();
            return view('hclinicas.show', compact(['paciente', 'antPersonales', 'representante', 'diagnostico', 'tipos_documento', 'tipos_nacionalidad']));
        } catch (\Exception $e) {
            return to_route('hclinicas.index')->with('danger', 'No se pudo mostrar la Historia Clinica.' . $e->getMessage());
            throw $e;
        }
    }

    public function edit(int $id)
    {
        $paciente = Paciente::getPacienteFormateado($id);
        $representante = Representante::where('paciente_id', $paciente->id)->first();
        $antPersonales = AntecedentesPersonalesFamiliare::where('paciente_id', $paciente->id)->first();
        $diagnostico = Diagnostico::where('paciente_id', $paciente->id)->first();
        $tipos_documento = TipoDocumento::orderBy('nombre', 'asc')->get();
        $tipos_nacionalidad = TipoNacionalidad::all();
        return view('hclinicas.edit', compact(['paciente', 'representante', 'antPersonales', 'diagnostico', 'tipos_documento', 'tipos_nacionalidad']));
    }

    public function update(Request $request, int $id_paciente)
    {
        try {
            DB::beginTransaction();
            $paciente = Paciente::findOrFail($id_paciente);
            //validar el ingreso de los datos
            $this->mostrarErroresDeValidacion($request);
            $this->validator($request->all())->validate();
            if (!$this->verificarCedulaDistinta($request)) {
                return to_route('hclinicas.create')->with('danger', 'La cédula del representante no puede ser igual a la del paciente.');
            }
            $this->guardarOActualizarPaciente($paciente, $request);
            $this->actualizarRepresentante($request, $paciente);
            //$this->guardarActualizarConsulta($request, $paciente);
            //$this->guardarActualizarAntecedentePatologico($request, $paciente);
            //$this->actualizarAntecedentePersonal($request, $paciente->id);
            //$this->actualizarDiagnostico($request, $paciente);
            DB::commit();
            return back()->with('message', 'Datos actualizados exitosamente');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('danger', 'No se pudo actualizar la Historia Clínica.' . $e->getMessage());
            throw $e;
        }
    }

    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            //buscar paciente
            $paciente = Paciente::findOrFail($id);
            if ($paciente) {
                //$this->eliminarAntecedenteInfeccioso($id);
                $this->eliminarAntecedentePersonal($id);
                $this->eliminarOdontogramas($id);
                $paciente->delete();
                DB::commit();
                return to_route('hclinicas.index')->with('message', 'Historia Clínica eliminada exitosamente');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return to_route('hclinicas.index')->with('danger', 'No se pudo eliminar la Historia Clínica. ');
            throw $e;
        }
    }

    private function guardarOActualizarPaciente(Paciente $paciente, Request $request)
    {
        $paciente->tipo_nacionalidad_id = $request->input('tipo_nacionalidad_id');
        $paciente->tipo_documento_id = $request->input('tipo_documento_id');
        $paciente->nombres = $request->input('nombres');
        $paciente->apellidos = $request->input('apellidos');
        $paciente->cedula = $request->input('cedula');
        $paciente->sexo = $request->input('sexo');
        $paciente->fecha_nacimiento =  $request->input('fecha_nacimiento');
        $paciente->estado_civil = $request->input('estado_civil');
        $paciente->ocupacion = $request->input('ocupacion');
        $paciente->direccion = $request->input('direccion');
        $paciente->celular = $request->input('celular');
        $paciente->telef_convencional = $request->input('telef_convencional');
        $paciente->consentimiento = $request->input('consentimiento');
        $paciente->save();
    }

    
    private function almacenarRepresentante(Request $request, int $paciente_id)
    {
        try {
            if ($this->verificarCedulaDistinta($request)) {
                $representante = new Representante();
                $representante->paciente_id = $paciente_id;
                $representante->representante = $request->input('representante');
                $representante->cedula_representante = $request->input('cedula_representante');
                $representante->save();
            } else {
                return back()->with('danger', 'La cédula del representante no puede ser igual a la del paciente.');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function almacenarAntecedentePersonales(Request $request, int $paciente_id)
    {
        //verificar que todos los campos dentro de la card de antecedentes personales y familiares no esten vacios
        if ($this->registraAntecendete($request)) {
            $antPersonales = new AntecedentesPersonalesFamiliare();
            $antPersonales->paciente_id = $paciente_id;
            $this->asignarVariablesDeAntecedentesPersonoles($antPersonales, $request);
            $antPersonales->save();
        }
    }

    //no se usa
    private function almacenarDiagnostico(Request $request, int $paciente_id)
    {
        if (null != $request->input('diagnostico') || null != $request->input('enfermedad_actual')) {
            $diagnostico = new Diagnostico();
            $diagnostico->paciente_id = $paciente_id;
            $diagnostico->diagnostico = $request->input('diagnostico');
            $diagnostico->enfermedad_actual = $request->input('enfermedad_actual');
            $diagnostico->save();
        }
    }

    private function actualizarAntecedentePersonal(Request $request, int $paciente_id)
    {
        //verifico si existe un antecedente personal y familiar del paciente
        $antPersonales = AntecedentesPersonalesFamiliare::where('paciente_id', $paciente_id)->first();
        //si no existe, lo creo
        if ($antPersonales == null) {
            $antPersonales = new AntecedentesPersonalesFamiliare();
            $antPersonales->paciente_id = $paciente_id;
        }
        if ($this->registraAntecendete($request)) {
            $this->asignarVariablesDeAntecedentesPersonoles($antPersonales, $request);
            $antPersonales->save();
        }
    }

    //Asignar variables de la vista de informacion que vienen del request
    private function asignarVariablesDeAntecedentesPersonoles(AntecedentesPersonalesFamiliare $antPersonales,   Request $request)
    {
        $antPersonales->enfermedades = $request->input('enfermedades');
        if ($request->input('enfermedades') != null || $request->input('enfermedades') != "") {
            $antPersonales->enfermedades = implode(",", $request->input('enfermedades'));
        }

        $antPersonales->habitos = $request->input('habitos');
        if ($antPersonales->habitos != null || $antPersonales->habitos != "") {
            $antPersonales->habitos = implode(",", $request->input('habitos'));
        }

        $antPersonales->parentesco = $request->input('parentesco');
        $antPersonales->medicamento = $request->input('medicamento');
        $antPersonales->embarazada = $request->input('embarazada');
        $antPersonales->semanas_embarazo = $request->input('semanas_embarazo');
        $antPersonales->otro_antecendente = $request->input('otro_antecendente');
        $antPersonales->otra_enfermedad = $request->input('otra_enfermedad');
        $antPersonales->otro_habito = $request->input('otro_habito');
    }

    private function actualizarRepresentante(Request $request, Paciente $paciente)
    {
        if ($this->verificarCedulaDistinta($request)) {
            //verificar si el paciente tiene un representante y lo actualiza
            if ($paciente->representante != null) {
                $paciente->representante->representante = $request->input('representante');
                $paciente->representante->cedula_representante = $request->input('cedula_representante');
                $paciente->representante->save();
            }
            //si el paciente no tiene representante y se ingreso uno nuevo, lo crea
            else
                $this->almacenarRepresentante($request, $paciente->id);
        } else {
            return back()->with('danger', 'La cédula del representante no puede ser igual a la del paciente.');
        }
    }

    private function actualizarDiagnostico(Request $request, Paciente $paciente)
    {
        //verifica si el paciente tiene un diagnostico y lo actualiza
        if ($paciente->diagnostico != null) {
            $paciente->diagnostico->diagnostico = $request->input('diagnostico');
            $paciente->diagnostico->enfermedad_actual = $request->input('enfermedad_actual');
            $paciente->diagnostico->save();
        } else
            $this->almacenarDiagnostico($request, $paciente->id);
    }

    private function registraAntecendete(Request $request)
    {
        if ($request->input('enfermedades') != null || $request->input('habitos') != null || $request->input('parentesco') != null || $request->input('medicamento') != null || $request->input('embarazada') != null || $request->input('semanas_embarazo') != null || $request->input('otro_antecendente') != null || $request->input('otra_enfermedad') != null || $request->input('otro_habito') != null) {
            return true;
        }
        return false;
    }

    private function verificarCedulaDistinta(Request $request)
    {
        //verificar que la cedula del representante no sea la misma que la del paciente
        if (($request->input('cedula_representante') != null) && ($request->input('cedula') != null)) {
            if ($request->input('cedula') == $request->input('cedula_representante')) {
                return false;
            }
        }
        return true;
    }

    private function eliminarAntecedenteInfeccioso(int $id)
    {
        //buscar antecedentes infecciosos
        $antInfecciosos = AntecedentesInfeccioso::where('paciente_id', $id)->first();
        $antInfecciosos->delete();
    }

    //Asignar variables de la vista de informacion que vienen del request
    private function asignarVariablesDeAntecedentesInfecciosos($antInfecciosos, Request $request)
    {
        $antInfecciosos->enfermedad_respiratoria = $request->input('enfermedad_respiratoria');
        $antInfecciosos->fiebre = $request->input('fiebre');
        $antInfecciosos->hospitalizado = $request->input('hospitalizado');
        $antInfecciosos->razon_hospitalizacion = $request->input('razon_hospitalizacion');
        $antInfecciosos->detectado_covid = $request->input('detectado_covid');
        $antInfecciosos->parentesco_covid = $request->input('parentesco_covid');
        $antInfecciosos->grado_contagio = $request->input('grado_contagio');
    }

    private function eliminarAntecedentePersonal(int $id)
    {
        //buscar antecedentes personales y familiares
        $antPersonales = AntecedentesPersonalesFamiliare::where('paciente_id', $id)->first();
        $antPersonales != null ? $antPersonales->delete() : null;
    }

    private function eliminarOdontogramas($id)
    {
        //recupera todos los odontogramas del paciente
        $odontogramas = Odontograma::where('paciente_id', $id)->get();

        foreach ($odontogramas as $odontograma) {
            OdontogramaDetalle::where('odontograma_cabecera_id', $odontograma->id)->delete();
            $odontograma->delete();
        }
    }
    private function actualizarAntecedenteInfeccioso(Request $request, int $id)
    {
        //buscar los antecedentes infecciosos del paciente
        $antInfecciosos = AntecedentesInfeccioso::where('paciente_id', $id)->first();
        $this->asignarVariablesDeAntecedentesInfecciosos($antInfecciosos, $request);
        $antInfecciosos->save();
    }

    //deprecated
    private function almacenarAntecedentesInfecciosos(Request $request, int $paciente_id)
    {
        $antInfecciosos = new AntecedentesInfeccioso();
        $antInfecciosos->paciente_id = $paciente_id;
        $this->asignarVariablesDeAntecedentesInfecciosos($antInfecciosos, $request);
        $antInfecciosos->save();
    }
}
