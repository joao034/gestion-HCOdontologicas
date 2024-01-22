<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    use HasFactory;

    protected $table = 'abonos';

    protected $fillable = [
        'monto',
        'odontograma_detalle_id',
    ];

    public function odontogramaDetalle()
    {
        return $this->belongsTo(OdontogramaDetalle::class, 'odontograma_detalle_id');
    }

    private function getTotalDeAbonosDeDetalle(int $id_detalle)
    {
        $abonos = Abono::where('odontograma_detalle_id', '=', "$id_detalle")->get();
        $sumatorio = 0;
        foreach ($abonos as $abono) {
            $sumatorio += $abono->monto;
        }
        return $sumatorio;
    }

}
