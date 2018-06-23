<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsultantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('consultants', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 50)->nullable();
			$table->string('apellido', 50)->nullable();
			$table->string('nivel_estudio', 50)->nullable();
			$table->string('especialidad', 50)->nullable();
			$table->string('correo', 50)->nullable()->unique('asesores_correo_uindex');
			$table->string('passw', 200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('consultants');
	}

}
