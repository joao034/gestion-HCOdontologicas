<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AntecedentesInfeccione
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool|null $enfermedad_respiratoria
 * @property bool|null $fiebre
 * @property bool|null $hospitalizado
 * @property string|null $razon_hospitalizacion
 * @property bool|null $detectado_covid
 * @property string|null $parentesco_covid
 * @property string|null $grado_contagio
 * @property int|null $paciente_id
 * 
 * @property Paciente|null $paciente
 *
 * @package App\Models
 */
class AntecedentesInfeccioso extends Model
{
	protected $table = 'antecedentes_infecciosos';

	protected $casts = [
		'enfermedad_respiratoria' => 'bool',
		'fiebre' => 'bool',
		'hospitalizado' => 'bool',
		'detectado_covid' => 'bool',
		'paciente_id' => 'int'
	];

	protected $fillable = [
		'enfermedad_respiratoria',
		'fiebre',
		'hospitalizado',
		'razon_hospitalizacion',
		'detectado_covid',
		'parentesco_covid',
		'grado_contagio',
		'paciente_id'
	];

	public function paciente()
	{
		return $this->belongsTo(Paciente::class);
	}
}
