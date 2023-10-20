<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

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

	use HasFactory;

	protected $table = 'pacientes';

	protected $casts = [
		'edad' => 'int'
	];

	protected $fillable = [
		'nombres',
		'apellidos',
		'cedula',
		'representante',
		'cedula_representante',
		'sexo',
		'fecha_nacimiento',
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

	public function calcularEdad()
	{

		$fecha_nacimiento = Carbon::parse($this->fecha_nacimiento);
		$fecha_actual = Carbon::now();
		$edad = $fecha_nacimiento->diffInYears($fecha_actual, false);
		$this->edad = $edad;
	}

	public static function getAllPacientesWithPagination($search, $ordeBay = 'apellidos', $order = 'asc')
	{
		return Paciente::where('nombres', 'LIKE', '%' . $search . '%')
			->orWhere('apellidos', 'LIKE', '%' . $search . '%')
			->orWhere('cedula', 'LIKE', '%' . $search . '%')
			->orderBy($ordeBay, $order)
			->paginate(10);
	}

	public static function getAllPacientesWithPaginationDB($search, $ordeBay = 'apellidos', $order = 'asc')
	{
		return DB::table('pacientes')->select('id', 'nombres', 'apellidos', 'cedula', 'celular', DB::raw('YEAR(CURDATE()) - YEAR(fecha_nacimiento) - IF(DATE_FORMAT(CURDATE(), "%m-%d") < DATE_FORMAT(fecha_nacimiento, "%m-%d"), 1, 0) as edad'))
			->orWhere('apellidos', 'LIKE', '%' . $search . '%')
			->orWhere('cedula', 'LIKE', '%' . $search . '%')
			->orderBy($ordeBay, $order)
			->paginate(10);
	}
}
