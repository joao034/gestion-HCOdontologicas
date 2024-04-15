<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Odontograma;
use App\Observers\OdontogramaDetalleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

/**
 * Class OdontogramaDetalle
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon $fecha
 * @property string $num_pieza_dental
 * @property string $cara_dental
 * @property string|null $simbolo
 * @property string|null $observacion
 * @property int $odontograma_cabecera_id
 * @property int $tratamiento_id
 * @property int $odontologo_id
 * 
 * @property OdontogramaCabecera $odontograma_cabecera
 * @property Odontologo $odontologo
 * @property Tratamiento $tratamiento
 * @property Simbolo $simbolo
 * 
 * @package App\Models
 */

 #[ObservedBy([OdontogramaDetalleObserver::class])]
class OdontogramaDetalle extends Model
{
	use HasFactory;
	protected $table = 'odontograma_detalle';

	protected $casts = [
		'odontograma_cabecera_id' => 'int',
		'tratamiento_id' => 'int',
		'odontologo_id' => 'int',
		'simbolo_id' => 'int',
	];

	protected $fillable = [
		'fecha_realizado',
		'num_pieza_dental',
		'cara_dental',
		'simbolo_id',
		'observacion',
		'odontograma_cabecera_id',
		'estado',
		'tratamiento_id',
		'odontologo_id',
		'precio'
	];

	public function odontograma_cabecera()
	{
		return $this->belongsTo(Odontograma::class);
	}

	public function odontologo()
	{
		return $this->belongsTo(Odontologo::class);
	}

	public function tratamiento()
	{
		return $this->belongsTo(Tratamiento::class);
	}

	public function simbolo()
	{
		return $this->belongsTo(Simbolo::class);
	}

	public function abonos()
	{
		return $this->hasMany(Abono::class);
	}

	public function retornar_caras_dentales($cara_dental_buscar) {
		
		$caras_dentales_array = explode(',', $this->cara_dental);
		
		foreach ($caras_dentales_array as $cara_dental) {
			if ( (trim( $cara_dental ) === trim( $cara_dental_buscar ))) {
				return true;
			}
		}
		return false;
	}

	public function get_total_abonos() {
		$abonos = Abono::where('odontograma_detalle_id', '=', "$this->id")->get();
		$sumatorio = 0;
		foreach ($abonos as $abono) {
			$sumatorio += $abono->monto;
		}
		return $sumatorio;
	}

}
