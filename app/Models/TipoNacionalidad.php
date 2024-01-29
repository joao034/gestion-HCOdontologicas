<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNacionalidad extends Model
{
    use HasFactory;

    protected $table = 'tipo_nacionalidad';

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'tipo_nacionalidad_id');
    }

    public function odontologos()
    {
        return $this->hasMany(Odontologo::class, 'tipo_nacionalidad_id');
    }
}
