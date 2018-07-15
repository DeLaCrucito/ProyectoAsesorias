<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 14 Jul 2018 17:09:48 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class State
 * 
 * @property int $id
 * @property string $nombre
 * @property string $icon
 * @property string $mensaje
 * @property string $color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $requests
 *
 * @package App\Models
 */
class State extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $fillable = [
		'nombre',
		'icon',
		'mensaje',
		'color'
	];

	public function requests()
	{
		return $this->hasMany(\App\Models\Request::class, 'estado');
	}
}
