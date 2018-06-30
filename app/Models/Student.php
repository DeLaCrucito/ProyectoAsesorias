<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 30 Jun 2018 17:19:29 +0000.
 */

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Student
 * 
 * @property int $id
 * @property int $matricula
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property int $licenciatura
 * @property int $semestre
 * @property string $password
 * @property bool $is_alumno
 * 
 * @property \App\Models\Degree $degree
 * @property \Illuminate\Database\Eloquent\Collection $requests
 *
 * @package App\Models
 */
class Student extends Eloquent implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    protected $guard = 'alumnos';
	public $timestamps = false;

	protected $casts = [
		'matricula' => 'int',
		'licenciatura' => 'int',
		'semestre' => 'int',
		'is_alumno' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'matricula',
		'nombre',
		'apellido',
		'correo',
		'licenciatura',
		'semestre',
		'password',
		'is_alumno'
	];

	public function degree()
	{
		return $this->belongsTo(\App\Models\Degree::class, 'licenciatura');
	}

	public function requests()
	{
		return $this->hasMany(\App\Models\Request::class, 'alumno');
	}
}
