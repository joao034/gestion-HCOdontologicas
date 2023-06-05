<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AntecedentesPersonalesFamiliare
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $paciente_id
 * @property string|null $enfermedades
 * @property string|null $parentesco
 * @property string|null $medicamento
 * @property bool|null $embarazada
 * @property int|null $semanas_embarazo
 * @property string|null $otro_antecendente
 * @property string|null $habitos
 * 
 * @property Paciente|null $paciente
 *
 * @package App\Models
 */
class AntecedentesPersonalesFamiliare extends Model
{
	protected $table = 'antecedentes_personales_familiares';

	protected $casts = [
		'paciente_id' => 'int',
		'embarazada' => 'bool',
		'semanas_embarazo' => 'int'
	];

	protected $fillable = [
		'paciente_id',
		'enfermedades',
		'parentesco',
		'medicamento',
		'embarazada',
		'semanas_embarazo',
		'otro_antecendente',
		'habitos',
		'otra_enfermedad',
		'otro_habito'
	];

	public function paciente()
	{
		return $this->belongsTo(Paciente::class);
	}
}
