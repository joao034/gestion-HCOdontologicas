<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorSaludBucal extends Model
{
    use HasFactory;

    protected $table = 'indicadores_salud';
    protected $fillable = ['odontograma_id', 'enfermedad_periodontal', 'tipo_oclusion', 'nivel_fluorosis'];

    public function odontograma()
    {
        return $this->belongsTo(Odontograma::class);
    }
}
