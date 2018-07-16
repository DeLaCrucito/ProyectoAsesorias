<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdministratorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('administrators', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('usuario', 50)->nullable()->unique('administradores_usuario_uindex');
			$table->string('password', 200)->nullable();
			$table->string('correo', 200)->nullable()->unique('administradores_correo_uindex');
			$table->boolean('is_admin')->nullable()->default(1);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('administrators');
	}

}
