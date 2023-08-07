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
		'paciente_id' => 'int',
		'total' => 'float'
	];

	protected $fillable = [
		'diagnostico',
		'enfermedad_actual',
		'fecha_creacion',
		'paciente_id',
		'total'
	];

	public function paciente()
	{
		return $this->belongsTo(Paciente::class);
	}

	public function odontograma_detalles()
	{ 
		return $this->hasMany(OdontogramaDetalle::class);
	}

	//devuelve el color pintado en la cara dental
    public function getColorCaraDentalAPintar( $cara_dental, $num_diente, $id_odontograma ){
		try{
			$color = '';
			$ultimo_detalle = $this->getUltimoDetalleOdontograma( $cara_dental, $num_diente, $id_odontograma );
			$simbolo = Simbolo::find($ultimo_detalle->simbolo_id);
			$color = $simbolo->color;
			return $color;
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}	
	
	//devuelve la ruta de la imagen del simbolo pintado en la cara dental
	public function getRutaImagenSimbolo( $num_diente, $id_odontograma ){
		try{
			$rutaImagen = '';
			$ultimo_detalle = $this->getUltimoDetalleOdontograma( 'oclusal', $num_diente, $id_odontograma );
			$simbolo = Simbolo::find($ultimo_detalle->simbolo_id);
			$rutaImagen = $simbolo->ruta_imagen; 
			return $rutaImagen;
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}

	private function getUltimoDetalleOdontograma( $cara_dental, $num_diente, $id_odontograma ){
		$detalles_odontograma = DB::table('odontograma_detalle')
								->where('num_pieza_dental', $num_diente)
								->where('cara_dental', 'like', '%'.$cara_dental.'%')
								->where('odontograma_cabecera_id', $id_odontograma)
								->get(); 
		if( !$detalles_odontograma->isEmpty() )
			$ultimo_detalle = $detalles_odontograma->last();
		return $ultimo_detalle;
	}

	public function getNumeroDeOdontogramasDeUnPaciente( $paciente_id ){
		$odontogramas = DB::table('odontograma_cabecera')
								->where('paciente_id', $paciente_id)
								->get(); 
		return $odontogramas->count();
	}	

}
