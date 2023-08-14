<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Broadcasting\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tratamiento
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $nombre
 * @property float $precio
 * 
 * @property Collection|OdontogramaDetalle[] $odontograma_detalles
 * @property Collection|PresupuestosDetalle[] $presupuestos_detalles
 *
 * @package App\Models
 */
class Tratamiento extends Model
{
	use HasFactory;
	
	protected $table = 'tratamientos';

	protected $casts = [
		'precio' => 'float'
	];

	protected $fillable = [
		'nombre',
		'precio'
	];

	public function odontograma_detalles()
	{
		return $this->hasMany(OdontogramaDetalle::class);
	}

	public function presupuestos_detalles()
	{
		return $this->hasMany(PresupuestosDetalle::class);
	}
}
