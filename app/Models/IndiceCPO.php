<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndiceCPO extends Model
{
    use HasFactory;

    protected $table = 'indice_cpo_ceo';

    protected $fillable = [
        'odontograma_id',
        'tipo',
        'caries',
        'perdidas',
        'obturadas'
    ];

    public function odontograma()
    {
        return $this->belongsTo(Odontograma::class, 'odontograma_cabecera_id');
    }
}
