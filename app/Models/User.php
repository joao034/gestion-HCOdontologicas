<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\MustVerifyEmail; //utiliza el middleware 'verified'
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	//Spatie roles
	//use HasRoles;

	use HasFactory;

	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'role',
		//'rol_id', 
		'active',
		'remember_token',
	];

	public function odontologo()
	{
		return $this->hasOne(Odontologo::class);
	}

	public static function get_odontologos_activos()
    {
        return User::where('role', '=', 'odontologo')
            ->where('active', '=', 1)
            ->get();
    }

	/* public function rol()
	{
		return $this->belongsTo(Rol::class, 'rol_id');
	} */
}
