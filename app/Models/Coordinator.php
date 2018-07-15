<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 14 Jul 2018 17:09:48 -0500.
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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Degree $degree
 * @property \Illuminate\Database\Eloquent\Collection $requests
 *
 * @package App\Models
 */
class Coordinator extends Eloquent implements Authenticatable
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Illuminate\Auth\Authenticatable;
    protected $guard = 'coordinadores';
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
