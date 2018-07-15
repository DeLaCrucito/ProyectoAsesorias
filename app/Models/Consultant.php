<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 14 Jul 2018 17:09:48 -0500.
 */

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Consultant
 * 
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $nivel_estudio
 * @property string $especialidad
 * @property string $correo
 * @property string $password
 * @property bool $is_asesor
 * @property string $lugar
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $assignments
 * @property \Illuminate\Database\Eloquent\Collection $requests
 * @property \Illuminate\Database\Eloquent\Collection $schedules
 *
 * @package App\Models
 */
class Consultant extends Eloquent implements Authenticatable
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Illuminate\Auth\Authenticatable;
    protected $guard = 'administradores';
	protected $casts = [
		'is_asesor' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nombre',
		'apellido',
		'nivel_estudio',
		'especialidad',
		'correo',
		'password',
		'is_asesor',
		'lugar'
	];

	public function assignments()
	{
		return $this->hasMany(\App\Models\Assignment::class, 'asesor');
	}

	public function requests()
	{
		return $this->hasMany(\App\Models\Request::class, 'asesor');
	}

	public function schedules()
	{
		return $this->hasMany(\App\Models\Schedule::class, 'asesor');
	}
}
