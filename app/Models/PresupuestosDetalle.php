<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PresupuestosDetalle
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $cantidad
 * @property float $subtotal
 * @property int $presupuesto_id
 * @property int $tratamiento_id
 * 
 * @property PresupuestoCabecera $presupuesto_cabecera
 * @property Tratamiento $tratamiento
 *
 * @package App\Models
 */
class PresupuestosDetalle extends Model
{
	protected $table = 'presupuestos_detalle';

	protected $casts = [
		'cantidad' => 'int',
		'subtotal' => 'float',
		'presupuesto_id' => 'int',
		'tratamiento_id' => 'int'
	];

	protected $fillable = [
		'cantidad',
		'subtotal',
		'presupuesto_id',
		'tratamiento_id'
	];

	public function presupuesto_cabecera()
	{
		return $this->belongsTo(PresupuestoCabecera::class, 'presupuesto_id');
	}

	public function tratamiento()
	{
		return $this->belongsTo(Tratamiento::class);
	}
}
