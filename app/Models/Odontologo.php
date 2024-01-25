<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

	use HasFactory;
	protected $table = 'odontologos';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'nombres',
		'apellidos',
		'cedula',
		'sexo',
		'celular',
		'user_id'
	];

	public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'odontologo_especialidad');
    }

	public function usuario(){
		return $this->belongsTo(User::class, 'user_id');
	}

	public function odontograma_detalles()
	{
		return $this->hasMany(OdontogramaDetalle::class);
	}

	public function get_nombres_especialidades()
	{
		$especialidades = $this->especialidades()->get();
		$nombres = [];
		foreach ($especialidades as $especialidad) {
			$nombres[] = $especialidad->nombre;
		}
		return implode(', ', $nombres);
	}
}
