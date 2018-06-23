<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 Jun 2018 21:44:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Degree
 * 
 * @property int $id
 * @property int $facultad
 * @property string $nombre
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
	public $timestamps = false;

	protected $casts = [
		'facultad' => 'int'
	];

	protected $fillable = [
		'facultad',
		'nombre'
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
