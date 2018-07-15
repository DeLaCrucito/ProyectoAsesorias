<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 14 Jul 2018 17:09:48 -0500.
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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Exploitation $exploitation
 * @property \App\Models\Request $request
 *
 * @package App\Models
 */
class Evaluation extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

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
