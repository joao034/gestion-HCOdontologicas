<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenComplementario extends Model
{
    use HasFactory;
    protected $table = 'examenes_complementarios';
    protected $fillable = ['hclinica_id', 'examenes_solicitados', 'tipos_examen', 'observaciones'];
    
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function retornar_tipos_examen($examen_checkeado)
    {
        if ($this->tipos_examen != null) {
            $tipos_examen_array = explode(',', $this->tipos_examen);

            foreach ($tipos_examen_array as $examen) {
                if ((trim($examen) === trim($examen_checkeado))) {
                    return true;
                }
            }
        }
        return false;
    }
}
