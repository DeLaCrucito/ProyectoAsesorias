<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Jul 2018 00:33:14 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Hour
 * 
 * @property int $id
 * @property int $asesor
 * @property \Carbon\Carbon $fechahora
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Consultant $consultant
 *
 * @package App\Models
 */
class Hour extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'asesor' => 'int'
	];

	protected $dates = [
		'fechahora'
	];

	protected $fillable = [
		'asesor',
		'fechahora'
	];

	public function consultant()
	{
		return $this->belongsTo(\App\Models\Consultant::class, 'asesor');
	}
    public function getFechahoraAttribute($value) {
        return Date($value);
    }
}
