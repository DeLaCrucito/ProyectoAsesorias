<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDegreesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('degrees', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('facultad')->nullable()->index('licenciatura_facultad_index');
			$table->string('nombre', 255)->nullable();
			$table->integer('semestres')->nullable();
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
		Schema::drop('degrees');
	}

}
