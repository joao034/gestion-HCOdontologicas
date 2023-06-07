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
    public function index()
    {
        //
        $pacientes = Paciente::all();
        $antecendentesInfecciones = AntecedentesInfeccioso::all();
        $antecendentesPersonales = AntecedentesPersonalesFamiliare::all();
        return view('hclinicas.index', compact(['pacientes', 'antecendentesInfecciones', 'antecendentesPersonales']));
    }

    /**
     * Show the form for creating a new resource.
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
        DB::beginTransaction();
        try {    
            //insertar paciente
            $paciente = new Paciente();
            $paciente->nombres = $request->input('nombres');
            $paciente->apellidos = $request->input('apellidos');
            $paciente->cedula = $request->input('cedula');
            $paciente->sexo = $request->input('sexo');
            $paciente->fecha_nacimiento = $request->input('fecha_nacimiento');
            $paciente->calcularEdad();
            $paciente->estado_civil = $request->input('estado_civil');
            $paciente->ocupacion = $request->input('ocupacion');
            $paciente->direccion = $request->input('direccion');
            $paciente->celular = $request->input('celular');
            $paciente->telef_convencional = $request->input('telef_convencional');
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
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show(Autor $autor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit( int $id )
    {
        //$hclinica = Paciente::find($id); // Obtener el registro específico a editar
        return view('hclinicas.info');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
        //
        DB::beginTransaction();
        try {    
            //insertar paciente
            $paciente = Paciente::findOrFail($id);
            $paciente->nombres = $request->input('nombres');
            $paciente->apellidos = $request->input('apellidos');
            $paciente->cedula = $request->input('cedula');
            $paciente->sexo = $request->input('sexo');
            $paciente->fecha_nacimiento = $request->input('fecha_nacimiento');
            $paciente->calcularEdad();
            $paciente->estado_civil = $request->input('estado_civil');
            $paciente->ocupacion = $request->input('ocupacion');
            $paciente->direccion = $request->input('direccion');
            $paciente->celular = $request->input('celular');
            $paciente->telef_convencional = $request->input('telef_convencional');
            $paciente->save();

            //buscar los antecedentes infecciosos del paciente
            $antInfecciosos = AntecedentesInfeccioso::where('paciente_id', $paciente->id)->first();

            //buscar los antecedentes personales y familiares del paciente
            $antPersonales = AntecedentesPersonalesFamiliare::where('paciente_id', $paciente->id)->first();

            DB::commit();
            return redirect()->route('hclinicas.index')->with('status', 'HClinica creado exitosamente');

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
        $autor = Autor::find($id);
        $autor->delete();
        return redirect()->route('autores.index')->with('status', 'Autor eliminado exitosamente');
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
        
        $antPersonales->enfermedades = implode(",", $request->input('enfermedades'));
        $antPersonales->parentesco = $request->input('parentesco');
        $antPersonales->medicamento = $request->input('medicamento');
        $antPersonales->embarazada = $request->input('embarazada');
        $antPersonales->semanas_embarazo = $request->input('semanas_embarazo');
        $antPersonales->otro_antecendente = $request->input('otro_antecendente');
        $antPersonales->habitos = implode(",", $request->input('habitos'));
        $antPersonales->otra_enfermedad = $request->input('otra_enfermedad');
        $antPersonales->otro_habito = $request->input('otro_habito');
    }
}
