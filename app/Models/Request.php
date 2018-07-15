<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 14 Jul 2018 17:09:48 -0500.
 */

namespace App\Models;

use Jenssegers\Date\Date;
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
 * @property int $estado
 * @property string $tipo
 * @property string $apoyo
 * @property string $tema
 * @property string $folio
 * @property string $periodo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\State $state
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
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'alumno' => 'int',
		'asesor' => 'int',
		'coordinador' => 'int',
		'materia' => 'int',
		'estado' => 'int'
	];

	protected $dates = [
		'fecha'
	];

	protected $fillable = [
		'alumno',
		'asesor',
		'coordinador',
		'materia',
		'fecha',
		'estado',
		'tipo',
		'apoyo',
		'tema',
		'folio',
		'periodo'
	];

	public function state()
	{
		return $this->belongsTo(\App\Models\State::class, 'estado');
	}

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

    public function getFechaAttribute($value) {
        return new Date($value);
    }

}
