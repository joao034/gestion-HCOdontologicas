<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OdontogramaCabecera
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $diagnostico
 * @property string|null $enfermedad_actual
 * @property Carbon $fecha_creacion
 * @property int $paciente_id
 * 
 * @property Paciente $paciente
 * @property Collection|OdontogramaDetalle[] $odontograma_detalles
 *
 * @package App\Models
 */
class Odontograma extends Model
{
	protected $table = 'odontograma_cabecera';

	protected $casts = [
		'paciente_id' => 'int'
	];

	protected $fillable = [
		'diagnostico',
		'enfermedad_actual',
		'fecha_creacion',
		'paciente_id'
	];

	public function paciente()
	{
		return $this->belongsTo(Paciente::class);
	}

	public function odontograma_detalles()
	{
		return $this->hasMany(OdontogramaDetalle::class);
	}
}
