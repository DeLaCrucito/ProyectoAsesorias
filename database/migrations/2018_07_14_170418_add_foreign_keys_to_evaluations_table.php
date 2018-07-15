<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('evaluations', function(Blueprint $table)
		{
			$table->foreign('aprovechamiento', 'evaluacion_aprovechamiento_id_fk')->references('id')->on('exploitations')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('solicitud', 'evaluacion_solicitud_id_fk')->references('id')->on('requests')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('evaluations', function(Blueprint $table)
		{
			$table->dropForeign('evaluacion_aprovechamiento_id_fk');
			$table->dropForeign('evaluacion_solicitud_id_fk');
		});
	}

}
