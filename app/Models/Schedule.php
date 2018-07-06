<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 05 Jul 2018 00:46:41 +0000.
 */

namespace App\Models;

use Carbon\Carbon;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Schedule
 * 
 * @property int $id
 * @property string $dia
 * @property \Carbon\Carbon $hr_inicio
 * @property \Carbon\Carbon $hr_fin
 * @property int $asesor
 * @property string $code
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
		'asesor',
		'code'
	];

	public function consultant()
	{
		return $this->belongsTo(\App\Models\Consultant::class, 'asesor');
	}

    public function getHrInicioAttribute($value) {
        return ucfirst($value);
    }

    public function getHrFinAttribute($value) {
        return ucfirst($value);
    }
    public function getDiaAttribute($value) {
        switch ($value) {
            case 1:
                $dia = 'Lunes';
                break;
            case 2:
                $dia = 'Martes';
                break;
            case 3:
                $dia = 'Miércoles';
                break;
            case 4:
                $dia = 'Jueves';
                break;
            case 5:
                $dia = 'Viernes';
                break;
        }
        return ucfirst($dia);
    }
}
