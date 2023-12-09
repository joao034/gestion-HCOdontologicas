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
 * @property string|null $otra_enfermedad
 * @property string|null $otro_habito
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

	public function retornar_enfermedades($enfermedadABuscar) {

		$enfermedadesArray = explode(',', $this->enfermedades);
	
		foreach ($enfermedadesArray as $enfermedad) {
			if ( (trim( $enfermedad ) === trim( $enfermedadABuscar ))) {
				return true;
			}
		}
		return false;	
	}

	public function retornar_habitos($habitoABuscar) {
		
		$habitosArray = explode(',', $this->habitos);
		
		foreach ($habitosArray as $habito) {
			if ( (trim( $habito ) === trim( $habitoABuscar ))) {
				return true;
			}
		}
		return false;
		
	}
}
