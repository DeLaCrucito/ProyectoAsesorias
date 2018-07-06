<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 05 Jul 2018 00:46:41 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Evaluation
 * 
 * @property int $id
 * @property int $solicitud
 * @property int $nota
 * @property int $aprovechamiento
 * 
 * @property \App\Models\Exploitation $exploitation
 * @property \App\Models\Request $request
 *
 * @package App\Models
 */
class Evaluation extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'solicitud' => 'int',
		'nota' => 'int',
		'aprovechamiento' => 'int'
	];

	protected $fillable = [
		'solicitud',
		'nota',
		'aprovechamiento'
	];

	public function exploitation()
	{
		return $this->belongsTo(\App\Models\Exploitation::class, 'aprovechamiento');
	}

	public function request()
	{
		return $this->belongsTo(\App\Models\Request::class, 'solicitud');
	}
}
