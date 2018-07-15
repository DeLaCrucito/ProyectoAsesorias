<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 14 Jul 2018 17:09:48 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Faculty
 * 
 * @property int $id
 * @property string $nombre
 * @property string $tipo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $degrees
 *
 * @package App\Models
 */
class Faculty extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $fillable = [
		'nombre',
		'tipo'
	];

	public function degrees()
	{
		return $this->hasMany(\App\Models\Degree::class, 'facultad');
	}
}
