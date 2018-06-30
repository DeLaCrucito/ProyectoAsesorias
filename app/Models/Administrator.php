<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 30 Jun 2018 17:19:29 +0000.
 */

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Administrator
 * 
 * @property int $id
 * @property string $usuario
 * @property string $password
 * @property string $correo
 * @property bool $is_admin
 *
 * @package App\Models
 */
class Administrator extends Eloquent  implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    protected $guard = 'administradores';
    public $timestamps = false;

	protected $casts = [
		'is_admin' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'usuario',
		'password',
		'correo',
		'is_admin'
	];
}
