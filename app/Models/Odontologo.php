<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Odontologo
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $nombres
 * @property string $apellidos
 * @property string $cedula
 * @property string $sexo
 * @property int $especialidad_id
 * @property string|null $celular
 * 
 * @property Especialidad $especialidade
 * @property Collection|OdontogramaDetalle[] $odontograma_detalles
 *
 * @package App\Models
 */
class Odontologo extends Model
{
	protected $table = 'odontologos';

	protected $casts = [
		'especialidad_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'nombres',
		'apellidos',
		'cedula',
		'sexo',
		'celular',
		'especialidad_id',
		'user_id'
	];

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class, 'especialidad_id');
	}

	public function usuario(){
		return $this->belongsTo(User::class, 'user_id');
	}

	public function odontograma_detalles()
	{
		return $this->hasMany(OdontogramaDetalle::class);
	}
}
