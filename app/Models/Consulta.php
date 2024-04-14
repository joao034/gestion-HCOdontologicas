<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    //delete
    /* public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    } */

    public function historia_clinica() : BelongsTo{
        return $this->belongsTo(HistoriaClinica::class);
    }

    public function retornar_partes_sistema_checkeadas($parte_sistema_checkeado)
    {
        if ($this->partes_examen_estomatognatico != null) {
            $partesArray = explode(',', $this->partes_examen_estomatognatico);

            foreach ($partesArray as $parte) {
                if ((trim($parte) === trim($parte_sistema_checkeado))) {
                    return true;
                }
            }
        }
        return false;
    }
}
