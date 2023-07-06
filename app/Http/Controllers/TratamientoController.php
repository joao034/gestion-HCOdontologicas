<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tratamiento;
use Illuminate\Support\Facades\Validator;

class TratamientoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Valida los datos del tratamiento del formulario.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric'],
        ]);
    }

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
            //valida el ingreso de los datos
            $this->validator($request->all())->validate();
            $this->storeAndUpdate($request, $tratamiento);
            
        }catch(\Exception $e){
            return to_route('tratamientos.index')->with('danger', 'No se pudo crear el tratamiento');
        }
        return to_route('tratamientos.index')->with('message', 'Tratamiento creado correctamente');
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
            //valida el ingreso de los datos
            $this->validator($request->all())->validate();
            $this->storeAndUpdate($request, $tratamiento);

        }catch(\Exception $e){
            return to_route('tratamientos.index')->with('danger', 'No se pudo actualizar el tratamiento');
        }
        return to_route('tratamientos.index')->with('message', 'Tratamiento actualizado correctamente');
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
