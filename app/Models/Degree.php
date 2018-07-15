<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 14 Jul 2018 17:09:48 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Degree
 * 
 * @property int $id
 * @property int $facultad
 * @property string $nombre
 * @property int $semestres
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Faculty $faculty
 * @property \Illuminate\Database\Eloquent\Collection $coordinators
 * @property \Illuminate\Database\Eloquent\Collection $students
 * @property \Illuminate\Database\Eloquent\Collection $subjects
 *
 * @package App\Models
 */
class Degree extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'facultad' => 'int',
		'semestres' => 'int'
	];

	protected $fillable = [
		'facultad',
		'nombre',
		'semestres'
	];

	public function faculty()
	{
		return $this->belongsTo(\App\Models\Faculty::class, 'facultad');
	}

	public function coordinators()
	{
		return $this->hasMany(\App\Models\Coordinator::class, 'licenciatura');
	}

	public function students()
	{
		return $this->hasMany(\App\Models\Student::class, 'licenciatura');
	}

	public function subjects()
	{
		return $this->hasMany(\App\Models\Subject::class, 'licenciatura');
	}
}
