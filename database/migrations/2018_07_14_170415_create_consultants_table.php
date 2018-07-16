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
			$table->string('nombre', 255)->nullable();
			$table->string('apellido', 255)->nullable();
			$table->string('nivel_estudio', 255)->nullable();
			$table->string('especialidad', 255)->nullable();
			$table->string('correo', 255)->nullable()->unique('asesores_correo_uindex');
			$table->string('password', 200)->nullable();
			$table->boolean('is_asesor')->nullable()->default(1);
			$table->string('lugar', 500)->nullable();
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
		Schema::drop('consultants');
	}

}
