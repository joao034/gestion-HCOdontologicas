<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Especialidade
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $nombre
 * @property string $descripcion
 * 
 * @property Collection|Odontologo[] $odontologos
 *
 * @package App\Models
 */
class Especialidad extends Model
{
	protected $table = 'especialidades';

	protected $fillable = [
		'nombre',
		'descripcion'
	];

	/* public function odontologos()
	{
		return $this->hasMany(Odontologo::class, 'especialidad_id');
	} */

	public function odontologos()
    {
        return $this->belongsToMany(Odontologo::class, 'odontologo_especialidad');
    }
}
