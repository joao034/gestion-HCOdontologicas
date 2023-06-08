<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tratamiento;

class TratamientoController extends Controller
{

    public function index()
    {
        $tratamientos = Tratamiento::all();
        return view('tratamientos.index', compact('tratamientos'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        try{
            $tratamiento = new Tratamiento();
            $tratamiento->nombre = $request->nombre;
            $tratamiento->precio = $request->precio;
            $tratamiento->save();
        }catch(\Exception $e){
            return redirect()->route('tratamientos.index')->with('error', 'No se pudo crear el tratamiento');
        }
        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento creado correctamente');
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
            $tratamiento = Tratamiento::find($id);
            $tratamiento->nombre = $request->nombre;
            $tratamiento->precio = $request->precio;
            $tratamiento->update();

        }catch(\Exception $e){
            return redirect()->route('tratamientos.index')->with('error', 'No se pudo actualizar el tratamiento');
        }
        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento actualizado correctamente');
    }

    public function destroy($id)
    {
        try{
            $tratamiento = Tratamiento::find($id);
            $tratamiento->delete();
        }catch(\Exception $e){  
            return redirect()->route('tratamientos.index')->with('error', 'No se pudo eliminar el tratamiento');
        }
        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento eliminado correctamente');
    }
}
