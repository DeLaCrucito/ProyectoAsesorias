<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 08 Jul 2018 16:43:46 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class State
 * 
 * @property int $id
 * @property string $nombre
 * 
 * @property \Illuminate\Database\Eloquent\Collection $requests
 *
 * @package App\Models
 */
class State extends Eloquent
{
	public $timestamps = false;

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
