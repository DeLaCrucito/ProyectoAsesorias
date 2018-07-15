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
			$table->dateTime('fecha')->nullable();
			$table->integer('estado')->nullable()->default(1)->index('requests_states_id_fk');
			$table->string('tipo', 50)->nullable();
			$table->string('apoyo', 50)->nullable();
			$table->string('tema')->nullable();
			$table->string('folio', 500)->nullable()->unique('requests_folio_uindex');
			$table->string('periodo')->nullable();
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
		Schema::drop('requests');
	}

}
