<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCoordinatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('coordinators', function(Blueprint $table)
		{
			$table->foreign('licenciatura', 'coordinador_licenciatura_id_fk')->references('id')->on('degrees')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('coordinators', function(Blueprint $table)
		{
			$table->dropForeign('coordinador_licenciatura_id_fk');
		});
	}

}
