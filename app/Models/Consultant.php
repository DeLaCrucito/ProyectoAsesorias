<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Jun 2018 00:27:09 +0000.
 */

namespace App\Models;

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
 * @property string $passw
 * 
 * @property \Illuminate\Database\Eloquent\Collection $assignments
 * @property \Illuminate\Database\Eloquent\Collection $requests
 * @property \Illuminate\Database\Eloquent\Collection $schedules
 *
 * @package App\Models
 */
class Consultant extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'apellido',
		'nivel_estudio',
		'especialidad',
		'correo',
		'passw'
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
