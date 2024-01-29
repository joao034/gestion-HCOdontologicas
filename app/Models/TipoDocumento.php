<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    protected $table = 'tipos_documento';

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'tipo_documento_id');
    }

    public function odontologos()
    {
        return $this->hasMany(Odontologo::class, 'tipo_documento_id');
    }
}
