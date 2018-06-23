<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('alumno')->nullable()->index('solicitud_alumno_index');
			$table->integer('asesor')->nullable()->index('solicitud_asesor_index');
			$table->integer('coordinador')->nullable()->index('solicitud_coordinador_index');
			$table->integer('materia')->nullable()->index('solicitud_materia_index');
			$table->date('fecha')->nullable();
			$table->time('horario')->nullable();
			$table->integer('estado')->nullable()->default(0);
			$table->string('tipo', 50)->nullable();
			$table->string('apoyo', 50)->nullable();
			$table->string('tema')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requests');
	}

}
