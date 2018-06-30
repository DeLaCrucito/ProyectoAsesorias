<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 30 Jun 2018 17:19:29 +0000.
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
 * 
 * @property \Illuminate\Database\Eloquent\Collection $assignments
 * @property \Illuminate\Database\Eloquent\Collection $requests
 * @property \Illuminate\Database\Eloquent\Collection $schedules
 *
 * @package App\Models
 */
class Consultant extends Eloquent implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    protected $guard = 'administradores';
	public $timestamps = false;

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
		'is_asesor'
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
