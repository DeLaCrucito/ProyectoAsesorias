<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDegreesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('degrees', function(Blueprint $table)
		{
			$table->foreign('facultad', 'licenciatura_facultad_id_fk')->references('id')->on('faculties')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('degrees', function(Blueprint $table)
		{
			$table->dropForeign('licenciatura_facultad_id_fk');
		});
	}

}
