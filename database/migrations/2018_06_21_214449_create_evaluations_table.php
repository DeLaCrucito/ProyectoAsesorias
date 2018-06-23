<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evaluations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('solicitud')->nullable();
			$table->integer('nota')->nullable();
			$table->integer('aprovechamiento')->nullable()->index('evaluacion_aprovechamiento_id_fk');
			$table->index(['solicitud','aprovechamiento'], 'evaluacion_solicitud_aprovechamiento_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('evaluations');
	}

}
