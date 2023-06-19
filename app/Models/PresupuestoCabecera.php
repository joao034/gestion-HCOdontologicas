<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PresupuestoCabecera
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon $fecha
 * @property float $total
 * @property int $paciente_id
 * 
 * @property Paciente $paciente
 * @property Collection|PresupuestosDetalle[] $presupuestos_detalles
 *
 * @package App\Models
 */
class PresupuestoCabecera extends Model
{
	protected $table = 'presupuesto_cabecera';

	protected $casts = [
		'fecha' => 'datetime',
		'total' => 'float',
		'paciente_id' => 'int'
	];

	protected $fillable = [
		'fecha',
		'total',
		'paciente_id'
	];

	public function paciente()
	{
		return $this->belongsTo(Paciente::class);
	}

	public function presupuestos_detalles()
	{
		return $this->hasMany(PresupuestosDetalle::class, 'presupuesto_id');
	}
}
