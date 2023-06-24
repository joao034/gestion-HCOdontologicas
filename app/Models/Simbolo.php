<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simbolo extends Model{

    protected $table = 'simbolos';

	protected $fillable = [
		'simbolo',
		'color',
        'ruta_imagen',
		'nombre'
	];

	public function odontograma_detalles()
	{
		return $this->hasMany(OdontogramaDetalle::class);
	}

	public function getSimbolosPorColor( $color ){
		return Simbolo::where('color', $color)->get();
	}

}


?>