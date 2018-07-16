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
			$table->string('nombre')->nullable();
			$table->string('apellido')->nullable();
			$table->string('nivel_estudio')->nullable();
			$table->string('especialidad')->nullable();
			$table->string('correo')->nullable()->unique('asesores_correo_uindex');
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
