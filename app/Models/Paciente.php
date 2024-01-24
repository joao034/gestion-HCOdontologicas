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

	protected $fillable = [
		'nombres',
		'apellidos',
		'cedula',
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
		return $this->hasOne(AntecedentesInfeccioso::class);
	}

	public function antecedentes_personales_familiares()
	{
		return $this->hasOne(AntecedentesPersonalesFamiliare::class);
	}

	public function odontogramasCabecera()
	{
		return $this->hasMany(Odontograma::class);
	}

	public function diagnostico()
	{
		return $this->hasOne(Diagnostico::class);
	}

	public function representante()
	{
		return $this->hasOne(Representante::class);
	}

	public function edad(){
		return Carbon::parse($this->fecha_nacimiento)->age;
	}

	//Devuelve la lista de pacientes con paginacion mediante eloquent
	public static function getAllPacientesWithPagination($search, $ordeBay = 'apellidos', $order = 'asc')
	{
		return Paciente::where('nombres', 'LIKE', '%' . $search . '%')
			->orWhere('apellidos', 'LIKE', '%' . $search . '%')
			->orWhere('cedula', 'LIKE', '%' . $search . '%')
			->orderBy($ordeBay, $order)
			->paginate(10);
	}

	//Devuelve la lista de pacientes con paginacion mediante Query Builder
	public static function getAllPacientesWithPaginationDB($search, $ordeBay = 'apellidos', $order = 'asc')
	{
		return DB::table('pacientes')->selectRaw('*, EXTRACT(YEAR FROM CURRENT_DATE) - EXTRACT(YEAR FROM fecha_nacimiento) - CASE WHEN EXTRACT(MONTH FROM CURRENT_DATE) * 100 + EXTRACT(DAY FROM CURRENT_DATE) < EXTRACT(MONTH FROM fecha_nacimiento) * 100 + EXTRACT(DAY FROM fecha_nacimiento) THEN 1 ELSE 0 END as edad')
			->orWhere('nombres', 'LIKE', '%' . $search . '%')
			->orWhere('apellidos', 'LIKE', '%' . $search . '%')
			->orWhere('cedula', 'LIKE', '%' . $search . '%')
			->orderBy($ordeBay, $order)
			->paginate(10);
	}

	public static function getPacienteFormateado(int $id)
	{
		return DB::table('pacientes')
			->selectRaw('*, EXTRACT(YEAR FROM CURRENT_DATE) - EXTRACT(YEAR FROM fecha_nacimiento) - CASE WHEN EXTRACT(MONTH FROM CURRENT_DATE) * 100 + EXTRACT(DAY FROM CURRENT_DATE) < EXTRACT(MONTH FROM fecha_nacimiento) * 100 + EXTRACT(DAY FROM fecha_nacimiento) THEN 1 ELSE 0 END as edad')
			->where('id', $id)
			->first();
	}
}
