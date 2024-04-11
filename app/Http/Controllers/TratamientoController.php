<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TratamientoRequest;
use Illuminate\Http\Request;
use App\Models\Tratamiento;
use Illuminate\Support\Facades\Validator;

class TratamientoController extends Controller
{

    public function __construct()
    {
        $this->middleware('role.admin');
    }

    public function index()
    {
        $tratamientos = Tratamiento::orderBy('nombre', 'asc')->get();
        return view('tratamientos.index', compact('tratamientos'));
    }

    public function create()
    {
    }

    public function store(TratamientoRequest $request)
    {
        try{
            $tratamiento = new Tratamiento();
            $this->storeAndUpdate($request, $tratamiento);
            return to_route('tratamientos.index')->with('message', 'Tratamiento creado correctamente');
        }catch(\Exception $e){
            return to_route('tratamientos.index')->with('danger', 'No se pudo crear el tratamiento');
        }
        
    }

    public function update(TratamientoRequest $request, Tratamiento $tratamiento)
    {
        try{
            $this->storeAndUpdate($request, $tratamiento);
            return to_route('tratamientos.index')->with('message', 'Tratamiento actualizado correctamente');
        }catch(\Exception $e){
            return to_route('tratamientos.index')->with('danger', 'No se pudo actualizar el tratamiento');
        }
    }

    public function destroy($id)
    {
        try{
            $tratamiento = Tratamiento::find($id);
            $tratamiento->delete();
        }catch(\Exception $e){  
            return to_route('tratamientos.index')->with('danger', 'No se pudo eliminar el tratamiento');
        }
        return to_route('tratamientos.index')->with('message', 'Tratamiento eliminado correctamente');
    }

    private function storeAndUpdate(Request $request, Tratamiento $tratamiento){
        $tratamiento->nombre = $request->nombre;
        $tratamiento->precio = $request->precio;
        $tratamiento->save();
    }
}
