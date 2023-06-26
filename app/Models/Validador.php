<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Validador extends Model
{
    
    public function __construct( $request ){
        $this->validarDatos( $request );
    }

    public function validarDatos( $request ){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}