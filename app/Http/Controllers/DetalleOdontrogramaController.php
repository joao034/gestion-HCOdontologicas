<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tratamiento;

class DetalleOdontrogramaController extends Controller
{
    //genera los metodos para el crud

    public function index()
    {
        //return $tratamientos;
        return view('odontogramas.index', compact('tratamientos'));
    }

    public function create()
    {
        return view('detalleOdontogramas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'idOdontograma' => 'required',
            'idDiente' => 'required',
            'idTratamiento' => 'required',
            'idEstado' => 'required',
            'idPaciente' => 'required',
            'idDoctor' => 'required',
            'idCita' => 'required',
            'idUsuario' => 'required',
            'fecha' => 'required',
            'observaciones' => 'required',
        ]);
        DetalleOdontograma::create($request->all());
        return redirect()->route('detalleOdontogramas.index');
    }

    public function show($id)
    {
        $detalleOdontograma = DetalleOdontograma::find($id);
        return view('detalleOdontogramas.show', compact('detalleOdontograma'));
    }

    public function edit($id)
    {
        $detalleOdontograma = DetalleOdontograma::find($id);
        return view('detalleOdontogramas.edit', compact('detalleOdontograma'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idOdontograma' => 'required',
            'idDiente' => 'required',
            'idTratamiento' => 'required',
            'idEstado' => 'required',
            'idPaciente' => 'required',
            'idDoctor' => 'required',
            'idCita' => 'required',
            'idUsuario' => 'required',
            'fecha' => 'required',
            'observaciones' => 'required',
        ]);
        DetalleOdontograma::find($id)->update($request->all());
        return redirect()->route('detalleOdontogramas.index');
    }

    public function destroy($id)
    {
        DetalleOdontograma::find($id)->delete();
        return redirect()->route('detalleOdontogramas.index');
    }



    
}
