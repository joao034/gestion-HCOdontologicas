<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HistoriaClinica extends Model
{
    use HasFactory;

    protected $table = 'historias_clinicas';
    protected $fillable = [
        'paciente_id',
        'odontologo_id',
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function odontologo(): BelongsTo
    {
        return $this->belongsTo(Odontologo::class);
    }

    public function odontograma(): HasOne
    {
        return $this->hasOne(Odontograma::class, 'hclinica_id');
    }

    public function consulta(): HasOne
    {
        return $this->hasOne(Consulta::class, 'hclinica_id');
    }

    public function diagnosticos(): HasMany
    {
        return $this->hasMany(Diagnostico::class, 'hclinica_id');
    }

    public function examenComplementario(): HasOne
    {
        return $this->hasOne(ExamenComplementario::class, 'hclinica_id');
    }

    public function antecedentes_patologicos()
	{
		return $this->hasOne(AntecedentePatologico::class, 'hclinica_id');
	}
}
