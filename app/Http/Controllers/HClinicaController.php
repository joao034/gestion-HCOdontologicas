<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AntecedentesInfeccione;
use App\Models\AntecedentesPersonalesFamiliare;
use App\Models\Paciente;
use Illuminate\Http\Request;

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
        $antecendentesInfecciones = AntecedentesInfeccione::all();
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
        $autor = new Autor();
        $autor->nombres = $request->input('nombres');
        $autor->apellidos = $request->input('apellidos');
        $autor->pais = $request->input('pais');
        $autor->provincia = $request->input('provincia');
        $autor->ciudad = $request->input('ciudad');
        $autor->biografia = $request->input('biografia');
        $autor->save();
        return redirect()->route('autores.index')->with('status', 'Autor creado exitosamente');
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
    public function edit(Autor $autor)
    {
        //
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
        $autor = Autor::find($id);
        $autor->nombres = $request->input('nombres');
        $autor->apellidos = $request->input('apellidos');
        $autor->pais = $request->input('pais');
        $autor->provincia = $request->input('provincia');
        $autor->ciudad = $request->input('ciudad');
        $autor->biografia = $request->input('biografia');
        $autor->update();
        return redirect()->route('autores.index')->with('status', 'Autor actualizado exitosamente');
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
}
