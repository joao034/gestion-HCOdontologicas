<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Utils;

class AntecedentePatologico extends Model
{
    use HasFactory;
    protected $table = 'antecedentes_patologicos';

    protected $fillable = [
        'id',
        'id_paciente',
        'ant_personales',
        'desc_personales',
        'ant_familiares',
        'desc_familiares',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function validar_checks_personales($ant_patologico)
    {
        if ($this->ant_personales != null) {
            $ant_patologico_array = explode(',', $this->ant_personales);

            foreach ($ant_patologico_array as $ant) {
                if ((trim($ant) === trim($ant_patologico))) {
                    return true;
                }
            }
        }
        return false;
    }

    public function validar_checks_familiares($ant_patologico)
    {
        if ($ant_patologico != null) {
            $ant_patologico_array = explode(',', $this->ant_familiares);

            foreach ($ant_patologico_array as $ant) {
                if ((trim($ant) === trim($ant_patologico))) {
                    return true;
                }
            }
        }
        return false;
    }
}
