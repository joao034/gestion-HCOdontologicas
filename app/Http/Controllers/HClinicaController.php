<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AntecedentesInfeccioso;
use App\Models\AntecedentesPersonalesFamiliare;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HClinicaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
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
        //
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
        //
        try {    
            DB::beginTransaction();
            //insertar paciente
            $paciente = new Paciente();
            $this->asignarVariablesDePaciente($paciente, $request);
            $paciente->save();

            //insertar antecedentes infecciosos
            $this->almacenarAntecedentesInfecciosos($request, $paciente->id);

            //insertar anteceentes personales y familiares
            $this->almacenarAntecedentePersonales($request, $paciente->id);

            DB::commit();

            return redirect()->route('hclinicas.index')->with('status', 'HClinica creado exitosamente');

        } catch (\Exception $e) {
            DB::rollback();
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
        //
        try { 
            DB::beginTransaction();   
            //buscar paciente
            $paciente = Paciente::findOrFail($id_paciente);
            $this->asignarVariablesDePaciente($paciente, $request);
            $paciente->save();

            //buscar los antecedentes infecciosos del paciente
            $antInfecciosos = AntecedentesInfeccioso::where('paciente_id', $paciente->id)->first();
            $this->asignarVariablesDeAntecedentesInfecciosos($antInfecciosos, $request);
            $antInfecciosos->save();

            //buscar los antecedentes personales y familiares del paciente
            $antPersonales = AntecedentesPersonalesFamiliare::where('paciente_id', $paciente->id)->first();
            $this->asignarVariablesDeAntecedentesPersonoles($antPersonales, $request);
            $antPersonales->save();

            DB::commit();
            return redirect()->route('hclinicas.index')->with('status', 'HClinica actualizada exitosamente');

        } catch (\Exception $e) {
            DB::rollback();
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
        //
        try {    
            DB::beginTransaction();
            //buscar paciente
            $paciente = Paciente::findOrFail($id);
            if( $paciente ){
                //buscar antecedentes infecciosos
                $antInfecciosos = AntecedentesInfeccioso::where('paciente_id', $id)->first();
                $antInfecciosos->delete();

                //buscar antecedentes personales y familiares
                $antPersonales = AntecedentesPersonalesFamiliare::where('paciente_id', $id)->first();
                $antPersonales->delete();

                $paciente->delete();
                DB::commit();
                return redirect()->route('hclinicas.index')->with('status', 'HClinica eliminada exitosamente');
            }

        } catch (\Exception $e) {
            DB::rollback();
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

    private function asignarVariablesDePaciente($paciente ,Request $request){
            
            $paciente->nombres = $request->input('nombres');
            $paciente->apellidos = $request->input('apellidos');
            $paciente->cedula = $request->input('cedula');
            $paciente->sexo = $request->input('sexo');
            $paciente->fecha_nacimiento =  $request->input('fecha_nacimiento');
            $paciente->calcularEdad();
            $paciente->estado_civil = $request->input('estado_civil');
            $paciente->ocupacion = $request->input('ocupacion');
            $paciente->direccion = $request->input('direccion');
            $paciente->celular = $request->input('celular');
            $paciente->telef_convencional = $request->input('telef_convencional');
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
        
        //
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
}
