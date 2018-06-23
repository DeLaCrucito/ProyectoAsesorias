<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 Jun 2018 21:44:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Assignment
 * 
 * @property int $id
 * @property int $asesor
 * @property int $materia
 * 
 * @property \App\Models\Consultant $consultant
 * @property \App\Models\Subject $subject
 *
 * @package App\Models
 */
class Assignment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'asesor' => 'int',
		'materia' => 'int'
	];

	protected $fillable = [
		'asesor',
		'materia'
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
