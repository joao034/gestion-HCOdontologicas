<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    //
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
            $especialidad->nombre = $request->nombre;
            $especialidad->descripcion = $request->descripcion;
            $especialidad->save();
        }catch(\Exception $e){
            return redirect()->route('especialidades.index')->with('error', 'No se pudo crear la especialidad');
        }
        return redirect()->route('especialidades.index')->with('success', 'Especialidad creada correctamente');
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
            $especialidad->nombre = $request->nombre;
            $especialidad->descripcion = $request->descripcion;
            $especialidad->update();

        }catch(\Exception $e){
            return redirect()->route('especialidades.index')->with('error', 'No se pudo actualizar la especialidad');
        }
        return redirect()->route('especialidades.index')->with('success', 'Especialidad actualizada correctamente');
    }

    public function destroy($id)
    {
        try{
            $especialidad = Especialidad::find($id);
            $especialidad->delete();
        }catch(\Exception $e){  
            return redirect()->route('especialidades.index')->with('error', 'No se pudo eliminar la especialidad');
        }
        return redirect()->route('especialidades.index')->with('success', 'Especialidad eliminada correctamente');
    }
}
