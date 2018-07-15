<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('matricula')->nullable()->unique('alumnos_matricula_uindex');
			$table->string('nombre')->nullable();
			$table->string('apellido')->nullable();
			$table->string('correo')->nullable()->unique('alumnos_correo_uindex');
			$table->integer('licenciatura')->nullable()->index('alumnos_licenciatura_index');
			$table->integer('semestre')->nullable();
			$table->string('password', 200)->nullable();
			$table->boolean('is_alumno')->nullable()->default(1);
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
		Schema::drop('students');
	}

}
