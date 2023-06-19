<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Paciente
 * 
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $cedula
 * @property string $sexo
 * @property Carbon $fecha_nacimiento
 * @property int $edad
 * @property string $estado_civil
 * @property string|null $ocupacion
 * @property string $direccion
 * @property string|null $celular
 * @property string|null $telef_convencional
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|AntecedentesInfeccioso[] $antecedentes_infecciosos
 * @property Collection|AntecedentesPersonalesFamiliare[] $antecedentes_personales_familiares
 * @property Collection|OdontogramaCabecera[] $odontograma_cabeceras
 * @property Collection|PresupuestoCabecera[] $presupuesto_cabeceras
 *
 * @package App\Models
 */
class Paciente extends Model
{
	protected $table = 'pacientes';

	protected $casts = [
		'edad' => 'int'
	];

	protected $fillable = [
		'nombres',
		'apellidos',
		'cedula',
		'sexo',
		'fecha_nacimiento',
		'edad',
		'estado_civil',
		'ocupacion',
		'direccion',
		'celular',
		'telef_convencional'
	];

	public function antecedentes_infecciosos()
	{
		return $this->hasMany(AntecedentesInfeccioso::class);
	}

	public function antecedentes_personales_familiares()
	{
		return $this->hasMany(AntecedentesPersonalesFamiliare::class);
	}

	public function odontogramasCabecera()
	{
		return $this->hasMany(Odontograma::class);
	}

	public function presupuesto_cabeceras()
	{
		return $this->hasMany(PresupuestoCabecera::class);
	}

	public function calcularEdad(){
	
		$fecha_nacimiento = Carbon::parse($this->fecha_nacimiento);
		$fecha_actual = Carbon::now();
		$edad = $fecha_nacimiento->diffInYears($fecha_actual, false);
		$this->edad = $edad;

	}

}
