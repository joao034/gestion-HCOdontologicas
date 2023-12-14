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
        'odontograma_id',
    ];

    public function odontograma()
    {
        return $this->belongsTo(Odontograma::class, 'odontograma_id');
    }
}
