<?php

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
		'tipo_nacionalidad_id',
		'tipo_documento_id',
		'user_id',
		'nombres',
		'apellidos',
		'num_identificacion',
		'genero',
		'celular'
	];

	public function historias_clinicas()
    {
        return $this->hasMany(HistoriaClinica::class);
    }

	public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'odontologo_especialidad');
    }

	public function tipo_documento()
	{
		return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
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

	public function get_full_name()
	{
		return $this->nombres . ' ' . $this->apellidos;
	}
}
