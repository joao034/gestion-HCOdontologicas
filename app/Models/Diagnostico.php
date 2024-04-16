<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $fillable = [
        'hclinica_id',
        'diagnostico',
        'CIE',
        'tipo'
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class);
    }

}
