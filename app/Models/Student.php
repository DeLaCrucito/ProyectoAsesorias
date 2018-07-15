<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 14 Jul 2018 17:09:48 -0500.
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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Degree $degree
 * @property \Illuminate\Database\Eloquent\Collection $requests
 *
 * @package App\Models
 */
class Student extends Eloquent implements Authenticatable
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Illuminate\Auth\Authenticatable;
    protected $guard = 'alumnos';

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
