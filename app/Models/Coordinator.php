<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Jun 2018 00:27:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Coordinator
 * 
 * @property int $id
 * @property int $licenciatura
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property string $usuario
 * @property int $passwd
 * 
 * @property \App\Models\Degree $degree
 * @property \Illuminate\Database\Eloquent\Collection $requests
 *
 * @package App\Models
 */
class Coordinator extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'licenciatura' => 'int',
		'passwd' => 'int'
	];

	protected $fillable = [
		'licenciatura',
		'nombre',
		'apellido',
		'correo',
		'usuario',
		'passwd'
	];

	public function degree()
	{
		return $this->belongsTo(\App\Models\Degree::class, 'licenciatura');
	}

	public function requests()
	{
		return $this->hasMany(\App\Models\Request::class, 'coordinador');
	}
}
