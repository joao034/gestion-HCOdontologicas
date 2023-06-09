<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EspecialidadController extends Controller
{
    /**
     * Valida los datos de la especialidad del formulario.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:255'],
        ]);
    }


    public function index()
    {
        $especialidades = Especialidad::all();
        return view('especialidades.index', compact('especialidades'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        try{
            $especialidad = new Especialidad();
            //valida el ingreso de los datos
            $this->validator($request->all())->validate();
            $this->storeAndUpdate($request, $especialidad);
            
        }catch(\Exception $e){
            return redirect()->route('especialidades.index')->with('danger', 'No se pudo crear la especialidad');
        }
        return redirect()->route('especialidades.index')->with('message', 'Especialidad creada correctamente');
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
            $especialidad = Especialidad::find($id);
            //valida el ingreso de los datos
            $this->validator($request->all())->validate();
            $this->storeAndUpdate($request, $especialidad);

        }catch(\Exception $e){
            return redirect()->route('especialidades.index')->with('danger', 'No se pudo actualizar la especialidad');
        }
        return redirect()->route('especialidades.index')->with('message', 'Especialidad actualizada correctamente');
    }

    public function destroy($id)
    {
        try{
            $especialidad = Especialidad::find($id);
            $especialidad->delete();
        }catch(\Exception $e){  
            return redirect()->route('especialidades.index')->with('danger', 'No se pudo eliminar la especialidad');
        }
        return redirect()->route('especialidades.index')->with('message', 'Especialidad eliminada correctamente');
    }

    private function storeAndUpdate( Request $request, Especialidad $especialidad ){
        $especialidad->nombre = $request->nombre;
        $especialidad->descripcion = $request->descripcion;
        $especialidad->save();
    }
}
