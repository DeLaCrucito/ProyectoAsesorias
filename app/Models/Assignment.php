<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 14 Jul 2018 17:09:48 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Assignment
 * 
 * @property int $id
 * @property int $asesor
 * @property int $materia
 * @property string $code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Consultant $consultant
 * @property \App\Models\Subject $subject
 *
 * @package App\Models
 */
class Assignment extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'asesor' => 'int',
		'materia' => 'int'
	];

	protected $fillable = [
		'asesor',
		'materia',
		'code'
	];

	public function consultant()
	{
		return $this->belongsTo(\App\Models\Consultant::class, 'asesor');
	}

	public function subject()
	{
		return $this->belongsTo(\App\Models\Subject::class, 'materia');
	}
}
