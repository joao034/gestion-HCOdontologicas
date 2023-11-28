<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Odontologo;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OdontologoController extends Controller
{

    public function __construct()
    {
        $this->middleware('role.admin');
    }

    /**
     * Valida los datos del odontodólogo del formulario.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'min:10', 'max:10', 'validar_cedula'],
            'sexo' => ['required', 'string', 'max:255'],
            'celular' => ['required', 'string', 'min:10', 'max:10'],
            'especialidad_id' => ['required', 'integer'],
        ]);
    }

    private function mostrarErroresDeValidacion( $request ){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function index()
    {
        $odontologos = Odontologo::all();    
        $especialidades = Especialidad::all();
        return view('odontologos.index', compact('odontologos', 'especialidades'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        try{
            $odontologo = new Odontologo();
            //valida el ingreso de los datos
            $this->mostrarErroresDeValidacion( $request );
            $this->validator($request->all())->validate();
            $this->storeAndUpdate($request, $odontologo);

        }catch(\Exception $e){
            return to_route('odontologos.index')->with('danger', 'No se pudo crear el odontólogo');
        }
        return to_route('odontologos.index')->with('message', 'Odontólogo creado correctamente');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }   

    public function update(Request $request, $id)
    {
        try{
            $odontologo = Odontologo::find($id);
            //valida el ingreso de los datos
            $this->mostrarErroresDeValidacion( $request );
            $this->validator($request->all())->validate();
            $this->storeAndUpdate($request, $odontologo);

        }catch(\Exception $e){
            return to_route('odontologos.index')->with('danger', 'No se pudo actualizar el odontólogo');
        }
        return to_route('odontologos.index')->with('message', 'Odontólogo actualizado correctamente');
    }

    public function destroy($id)
    {
        try{
            $odontologo = Odontologo::find($id);
            $odontologo->delete();
        }catch(\Exception $e){  
            return to_route('odontologos.index')->with('danger', 'No se pudo eliminar el odontólogo');
        }
        return to_route('odontologos.index')->with('message', 'Odontólogo eliminado correctamente');
    }

    private function storeAndUpdate(Request $request, $odontologo){
            $odontologo->nombres = $request->nombres;
            $odontologo->apellidos = $request->apellidos;
            $odontologo->cedula = $request->cedula;
            $odontologo->sexo = $request->sexo;
            $odontologo->celular = $request->celular;
            $odontologo->especialidad_id = $request->especialidad_id;
            $odontologo->save();
    }
}
