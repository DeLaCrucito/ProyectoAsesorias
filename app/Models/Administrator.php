<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Jun 2018 00:27:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Administrator
 * 
 * @property int $id
 * @property string $usuario
 * @property string $passwd
 * @property string $correo
 *
 * @package App\Models
 */
class Administrator extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'usuario',
		'passwd',
		'correo'
	];
}
