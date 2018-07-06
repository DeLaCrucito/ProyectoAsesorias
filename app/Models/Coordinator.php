<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 30 Jun 2018 17:19:29 +0000.
 */

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Coordinator
 * 
 * @property int $id
 * @property int $licenciatura
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property string $password
 * @property bool $is_coor
 * 
 * @property \App\Models\Degree $degree
 * @property \Illuminate\Database\Eloquent\Collection $requests
 *
 * @package App\Models
 */
class Coordinator extends Eloquent implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    protected $guard = 'coordinadores';
	public $timestamps = false;

	protected $casts = [
		'licenciatura' => 'int',
		'is_coor' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'licenciatura',
		'nombre',
		'apellido',
		'correo',
		'password',
		'is_coor'
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
