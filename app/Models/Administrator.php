<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 14 Jul 2018 17:09:48 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class Administrator
 * 
 * @property int $id
 * @property string $usuario
 * @property string $password
 * @property string $correo
 * @property bool $is_admin
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Administrator extends Eloquent implements Authenticatable
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Illuminate\Auth\Authenticatable;
    protected $guard = 'administradores';

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
