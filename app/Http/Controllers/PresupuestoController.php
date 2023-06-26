<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    //
    public function index()
    {
        return view('presupuestos.index');
    }

    public function store( Request $request ){

    }

    public function edit( Request $request, int $id ){

    }

    

}
