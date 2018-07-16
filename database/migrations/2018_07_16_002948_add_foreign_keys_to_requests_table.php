<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('requests', function(Blueprint $table)
		{
			$table->foreign('estado', 'requests_states_id_fk')->references('id')->on('states')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('alumno', 'solicitud_alumnos_id_fk')->references('id')->on('students')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('asesor', 'solicitud_asesores_id_fk')->references('id')->on('consultants')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('coordinador', 'solicitud_coordinador_id_fk')->references('id')->on('coordinators')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('materia', 'solicitud_materia_id_fk')->references('id')->on('subjects')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('requests', function(Blueprint $table)
		{
			$table->dropForeign('requests_states_id_fk');
			$table->dropForeign('solicitud_alumnos_id_fk');
			$table->dropForeign('solicitud_asesores_id_fk');
			$table->dropForeign('solicitud_coordinador_id_fk');
			$table->dropForeign('solicitud_materia_id_fk');
		});
	}

}
