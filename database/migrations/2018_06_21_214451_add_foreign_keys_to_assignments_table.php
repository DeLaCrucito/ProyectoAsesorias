<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('assignments', function(Blueprint $table)
		{
			$table->foreign('asesor', 'asignacion_asesores_id_fk')->references('id')->on('consultants')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('materia', 'asignacion_materia_id_fk')->references('id')->on('subjects')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('assignments', function(Blueprint $table)
		{
			$table->dropForeign('asignacion_asesores_id_fk');
			$table->dropForeign('asignacion_materia_id_fk');
		});
	}

}
