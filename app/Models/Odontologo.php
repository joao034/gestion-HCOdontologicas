<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
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
 * 
 * @property Especialidade $especialidade
 *
 * @package App\Models
 */
class Odontologo extends Model
{
	protected $table = 'odontologos';

	protected $casts = [
		'especialidad_id' => 'int'
	];

	protected $fillable = [
		'nombres',
		'apellidos',
		'cedula',
		'sexo',
		'especialidad_id'
	];

	public function especialidade()
	{
		return $this->belongsTo(Especialidade::class, 'especialidad_id');
	}
}
