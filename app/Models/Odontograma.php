<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class OdontogramaCabecera
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $diagnostico
 * @property string|null $enfermedad_actual
 * @property Carbon $fecha_creacion
 * @property int $paciente_id
 * 
 * @property Paciente $paciente
 * @property Collection|OdontogramaDetalle[] $odontograma_detalles
 *
 * @package App\Models
 */
class Odontograma extends Model
{
	protected $table = 'odontograma_cabecera';

	protected $casts = [
		'paciente_id' => 'int'
	];

	protected $fillable = [
		'diagnostico',
		'enfermedad_actual',
		'fecha_creacion',
		'paciente_id',
		'simbolo_id'
	];

	public function paciente()
	{
		return $this->belongsTo(Paciente::class);
	}

	public function odontograma_detalles()
	{
		return $this->hasMany(OdontogramaDetalle::class);
	}

	//devuelve el color a pintar en la cara dental
    public function pintarCaraDental( $cara_dental, $num_diente, $id_odontograma ){

        //encontrar el detalle del odontograma a pintar
		try{
			$detalles_odontograma = DB::table('odontograma_detalle')
								->where('num_pieza_dental', $num_diente)
								->where('cara_dental', $cara_dental)
								->where('odontograma_cabecera_id', $id_odontograma)
								->get(); 

			$color = '';
			if( !$detalles_odontograma->isEmpty() ){
				$ultimo_detalle = $detalles_odontograma->last();
				$simbolo = Simbolo::find($ultimo_detalle->simbolo_id);
				$color = 'background-color:'.$simbolo->color.';'; 
			}
			return $color;
		}catch(\Exception $e){
			return $e->getMessage();
		}
        

    }
}
