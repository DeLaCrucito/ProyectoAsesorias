<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 30 Jun 2018 17:19:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Schedule
 * 
 * @property int $id
 * @property string $dia
 * @property \Carbon\Carbon $hr_inicio
 * @property \Carbon\Carbon $hr_fin
 * @property int $asesor
 * 
 * @property \App\Models\Consultant $consultant
 *
 * @package App\Models
 */
class Schedule extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'asesor' => 'int'
	];

	protected $dates = [
		'hr_inicio',
		'hr_fin'
	];

	protected $fillable = [
		'dia',
		'hr_inicio',
		'hr_fin',
		'asesor'
	];

	public function consultant()
	{
		return $this->belongsTo(\App\Models\Consultant::class, 'asesor');
	}
}
