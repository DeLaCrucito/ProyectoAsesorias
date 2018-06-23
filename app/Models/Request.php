<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 Jun 2018 21:44:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Request
 * 
 * @property int $id
 * @property int $alumno
 * @property int $asesor
 * @property int $coordinador
 * @property int $materia
 * @property \Carbon\Carbon $fecha
 * @property \Carbon\Carbon $horario
 * @property int $estado
 * @property string $tipo
 * @property string $apoyo
 * @property string $tema
 * 
 * @property \App\Models\Student $student
 * @property \App\Models\Consultant $consultant
 * @property \App\Models\Coordinator $coordinator
 * @property \App\Models\Subject $subject
 * @property \Illuminate\Database\Eloquent\Collection $evaluations
 *
 * @package App\Models
 */
class Request extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'alumno' => 'int',
		'asesor' => 'int',
		'coordinador' => 'int',
		'materia' => 'int',
		'estado' => 'int'
	];

	protected $dates = [
		'fecha',
		'horario'
	];

	protected $fillable = [
		'alumno',
		'asesor',
		'coordinador',
		'materia',
		'fecha',
		'horario',
		'estado',
		'tipo',
		'apoyo',
		'tema'
	];

	public function student()
	{
		return $this->belongsTo(\App\Models\Student::class, 'alumno');
	}

	public function consultant()
	{
		return $this->belongsTo(\App\Models\Consultant::class, 'asesor');
	}

	public function coordinator()
	{
		return $this->belongsTo(\App\Models\Coordinator::class, 'coordinador');
	}

	public function subject()
	{
		return $this->belongsTo(\App\Models\Subject::class, 'materia');
	}

	public function evaluations()
	{
		return $this->hasMany(\App\Models\Evaluation::class, 'solicitud');
	}
}
