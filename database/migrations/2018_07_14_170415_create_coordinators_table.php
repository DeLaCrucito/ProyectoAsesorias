<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoordinatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coordinators', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('licenciatura')->nullable()->index('coordinador_licenciatura_index');
			$table->string('nombre')->nullable();
			$table->string('apellido')->nullable();
			$table->string('correo')->nullable()->unique('coordinador_correo_uindex');
			$table->string('password', 200)->nullable();
			$table->boolean('is_coor')->nullable()->default(1);
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
		Schema::drop('coordinators');
	}

}
