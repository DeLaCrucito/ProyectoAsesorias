<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoordinatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coordinators', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('licenciatura')->nullable()->index('coordinador_licenciatura_index');
			$table->string('nombre', 50)->nullable();
			$table->string('apellido', 50)->nullable();
			$table->string('correo', 50)->nullable()->unique('coordinador_correo_uindex');
			$table->string('usuario', 50)->nullable()->unique('coordinador_usuario_uindex');
			$table->integer('passwd')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('coordinators');
	}

}
