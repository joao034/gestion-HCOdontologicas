<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class TestController extends Controller{

    public function index(){
        return response()->json(Paciente::all());
    }

    public function show($id){
        return response()->json(Paciente::find($id));
    }

    public function store(Request $request){
        $paciente = Paciente::create($request->all());
        return response()->json($paciente, 201);
    }

}