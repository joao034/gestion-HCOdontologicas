<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $fillable = [
        'paciente_id',
        'motivo_consulta',
        'enfermedad_actual',
        'presion_arterial',
        'frecuencia_cardiaca',
        'frecuencia_respiratoria',
        'temperatura',
        'partes_examen_estomatognatico',
        'observaciones_examen',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }


}
