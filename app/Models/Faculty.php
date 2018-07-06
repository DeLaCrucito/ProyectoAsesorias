<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 05 Jul 2018 00:46:41 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Faculty
 * 
 * @property int $id
 * @property string $nombre
 * @property string $tipo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $degrees
 *
 * @package App\Models
 */
class Faculty extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'tipo'
	];

	public function degrees()
	{
		return $this->hasMany(\App\Models\Degree::class, 'facultad');
	}
}
