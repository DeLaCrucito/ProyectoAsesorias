<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Jun 2018 00:27:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Subject
 * 
 * @property int $id
 * @property int $licenciatura
 * @property string $nombre
 * @property int $fase
 * @property int $semestre
 * @property string $clave
 * @property string $tipo
 * 
 * @property \App\Models\Degree $degree
 * @property \Illuminate\Database\Eloquent\Collection $assignments
 * @property \Illuminate\Database\Eloquent\Collection $requests
 *
 * @package App\Models
 */
class Subject extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'licenciatura' => 'int',
		'fase' => 'int',
		'semestre' => 'int'
	];

	protected $fillable = [
		'licenciatura',
		'nombre',
		'fase',
		'semestre',
		'clave',
		'tipo'
	];

	public function degree()
	{
		return $this->belongsTo(\App\Models\Degree::class, 'licenciatura');
	}

	public function assignments()
	{
		return $this->hasMany(\App\Models\Assignment::class, 'materia');
	}

	public function requests()
	{
		return $this->hasMany(\App\Models\Request::class, 'materia');
	}
}
