<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Jun 2018 00:27:09 +0000.
 */

namespace App\Models;

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
 * @property string $passwd
 * 
 * @property \App\Models\Degree $degree
 * @property \Illuminate\Database\Eloquent\Collection $requests
 *
 * @package App\Models
 */
class Student extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'matricula' => 'int',
		'licenciatura' => 'int',
		'semestre' => 'int'
	];

	protected $fillable = [
		'matricula',
		'nombre',
		'apellido',
		'correo',
		'licenciatura',
		'semestre',
		'passwd'
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
