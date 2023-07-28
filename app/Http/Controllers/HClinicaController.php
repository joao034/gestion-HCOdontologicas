<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AntecedentesInfeccioso;
use App\Models\AntecedentesPersonalesFamiliare;
use App\Models\Paciente;
use App\Models\Odontograma;
use App\Models\OdontogramaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HClinicaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Valida los datos de la HCOdontologica del formulario.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cedula' => ['validar_cedula','required', 'string', 'min:10', 'max:10'],
            'cedula_representante' => ['nullable', 'string', 'min:10', 'max:10', 'validar_cedula'],
            'representante' => ['nullable', 'string', 'max:100'],
            'fecha_nacimiento' => ['required', 'date'],
            'edad' => ['required', 'integer', 'min:0', 'max:120'],
            'estado_civil' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'ocupacion' => ['required', 'string', 'max:255'],
            'sexo' => ['required', 'string', 'max:255'],
            'celular' => ['nullable', 'min:10', 'max:10'],
            'telef_convencional' => ['nullable', 'min:6', 'max:9'],
        ]);
    }

    private function mostrarErroresDeValidacion( $request ){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    } 
    
    /**
     * Despliega la lista de pacientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $search = trim($request->get('buscador'));
        $pacientes = DB::table('pacientes')->select('id', 'cedula', 'nombres', 'apellidos','edad', 'celular')
                        ->where( 'cedula' , 'LIKE', '%' . $search . '%' )
                        ->orWhere( 'nombres' , 'LIKE', '%' . $search . '%' )
                        ->orWhere( 'apellidos' , 'LIKE', '%' . $search . '%' )
                        ->orderBy('apellidos', 'asc')
                        ->paginate(10);

        return view('hclinicas.index', compact(['pacientes', 'search']));
    }

    /**
     * Muestra la vista create.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("hclinicas.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {    
            DB::beginTransaction();
            $paciente = new Paciente();
            //validar los datos
            $this->mostrarErroresDeValidacion($request);  
            $this->validator($request->all())->validate();
                     
            $this->guardarOActualizarPaciente( $paciente, $request );
            //insertar antecedentes
            $this->almacenarAntecedentesInfecciosos( $request, $paciente->id );
            $this->almacenarAntecedentePersonales( $request, $paciente->id );
            //inserta el registro en la tabla odontogramaCabecera
            $this->crearOdontograma( $paciente->id );
            DB::commit();
            return to_route('hclinicas.index')->with('message', 'Historia Clinica creado exitosamente');
        } catch (\Exception $e) {
            DB::rollback();
            return to_route('hclinicas.create')->with('danger', 'No se pudo crear la Historia Clinica. ');
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\  $autor
     * @return \Illuminate\Http\
     */
    public function show()
    {
        //
    }

    /**
     * Muesta la vista info
     *
     * @param  \App\Models\  $id_paciente
     * @return \Illuminate\Http\
     */
    public function edit( int $id )
    {
        $paciente = Paciente::find($id); // Obtener el registro específico a editar
        //buscar los antecedentes infecciosos del paciente
        $antInfecciosos = AntecedentesInfeccioso::where('paciente_id', $paciente->id)->first();
        //buscar los antecedentes personales y familiares del paciente
        $antPersonales = AntecedentesPersonalesFamiliare::where('paciente_id', $paciente->id)->first();
        return view('hclinicas.edit', compact(['paciente', 'antInfecciosos', 'antPersonales']));
    }

    /**
     * Actualiza la hclinica del paciente en storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $id_paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id_paciente)
    {
        try { 
            DB::beginTransaction();   
            $paciente = Paciente::findOrFail($id_paciente);
            //validar el ingreso de los datos
            $this->mostrarErroresDeValidacion($request);  
            $this->validator($request->all())->validate();

            $this->guardarOActualizarPaciente($paciente, $request);
            $this->actualizarAntecedenteInfeccioso($request, $paciente->id);
            $this->actualizarAntecedentePersonal($request, $paciente->id);

            DB::commit();
            return to_route('hclinicas.index')->with('message', 'Historia Clínica actualizada exitosamente');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('danger', 'No se pudo actualizar la Historia Clínica. ');
            throw $e;
        }
    }

    /**
     * Eliminar la hclinica del storage.
     *
     * @param  \App\Models\Paciente  $id_paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {    
            DB::beginTransaction();
            //buscar paciente
            $paciente = Paciente::findOrFail($id);
            if( $paciente ){

                $this->eliminarAntecedenteInfeccioso( $id );
                $this->eliminarAntecedentePersonal( $id );
                $this->eliminarOdontogramas( $id );
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

    private function almacenarAntecedentesInfecciosos( Request $request, int $paciente_id ){

        $antInfecciosos = new AntecedentesInfeccioso();
        $antInfecciosos->paciente_id = $paciente_id;
        
        $this->asignarVariablesDeAntecedentesInfecciosos($antInfecciosos, $request);

        $antInfecciosos->save();

    }

    private function almacenarAntecedentePersonales( Request $request, int $paciente_id ){
        
        $antPersonales = new AntecedentesPersonalesFamiliare();
        $antPersonales->paciente_id = $paciente_id;
       
        $this->asignarVariablesDeAntecedentesPersonoles($antPersonales, $request);

        $antPersonales->save();

    }

    private function guardarOActualizarPaciente( Paciente $paciente ,Request $request){
            $paciente->nombres = $request->input('nombres');
            $paciente->apellidos = $request->input('apellidos');
            $paciente->cedula = $request->input('cedula');
            $paciente->representante = $request->input('representante');
            $paciente->cedula_representante = $request->input('cedula_representante');
            $paciente->sexo = $request->input('sexo');
            $paciente->fecha_nacimiento =  $request->input('fecha_nacimiento');
            $paciente->calcularEdad();
            $paciente->estado_civil = $request->input('estado_civil');
            $paciente->ocupacion = $request->input('ocupacion');
            $paciente->direccion = $request->input('direccion');
            $paciente->celular = $request->input('celular');
            $paciente->telef_convencional = $request->input('telef_convencional');
            $paciente->save();
    }
    
    //Asignar variables de la vista de informacion que vienen del request
    private function asignarVariablesDeAntecedentesInfecciosos($antInfecciosos, Request $request){
        
        $antInfecciosos->enfermedad_respiratoria = $request->input('enfermedad_respiratoria');
        $antInfecciosos->fiebre = $request->input('fiebre');
        $antInfecciosos->hospitalizado = $request->input('hospitalizado');
        $antInfecciosos->razon_hospitalizacion = $request->input('razon_hospitalizacion');
        $antInfecciosos->detectado_covid = $request->input('detectado_covid');
        $antInfecciosos->parentesco_covid = $request->input('parentesco_covid');
        $antInfecciosos->grado_contagio = $request->input('grado_contagio');
        
    }

    //Asignar variables de la vista de informacion que vienen del request
    private function asignarVariablesDeAntecedentesPersonoles($antPersonales, Request $request){
  
        $antPersonales->enfermedades = $request->input('enfermedades');
        if($antPersonales->enfermedades != null || $antPersonales->enfermedades != ""){
            $antPersonales->enfermedades = implode(",", $request->input('enfermedades'));
        }

        $antPersonales->habitos = $request->input('habitos');
        if($antPersonales->habitos != null || $antPersonales->habitos != ""){
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

    private function actualizarAntecedenteInfeccioso( Request $request, int $id ){
        //buscar los antecedentes infecciosos del paciente
        $antInfecciosos = AntecedentesInfeccioso::where('paciente_id', $id)->first();
        $this->asignarVariablesDeAntecedentesInfecciosos($antInfecciosos, $request);
        $antInfecciosos->save();
    }

    private function actualizarAntecedentePersonal( Request $request, int $id ){
        //buscar los antecedentes personales y familiares del paciente
        $antPersonales = AntecedentesPersonalesFamiliare::where('paciente_id', $id)->first();
        $this->asignarVariablesDeAntecedentesPersonoles($antPersonales, $request);
        $antPersonales->save();
    }

    private function eliminarAntecedenteInfeccioso( int $id ){
        //buscar antecedentes infecciosos
        $antInfecciosos = AntecedentesInfeccioso::where('paciente_id', $id)->first();
        $antInfecciosos->delete();
    }

    private function eliminarAntecedentePersonal( int $id ){
        //buscar antecedentes personales y familiares
        $antPersonales = AntecedentesPersonalesFamiliare::where('paciente_id', $id)->first();
        $antPersonales->delete();
    }

    private function eliminarOdontogramas ( $id ) {
        //recupera todos los odontogramas del paciente
        $odontogramas = Odontograma::where('paciente_id', $id)->get(); 
                
        foreach( $odontogramas as $odontograma ){
            OdontogramaDetalle::where('odontograma_cabecera_id', $odontograma->id)->delete();
            $odontograma->delete();
        }
}

    private function crearOdontograma( int $id_paciente ){
        $odontograma = new Odontograma();
        $odontograma->paciente_id = $id_paciente;
        $odontograma->fecha_creacion = now();
        $odontograma->total = 0;
        $odontograma->save();
    }




}
