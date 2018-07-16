<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hours', function(Blueprint $table)
		{
			$table->foreign('asesor', 'hours_consultants_id_fk')->references('id')->on('consultants')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hours', function(Blueprint $table)
		{
			$table->dropForeign('hours_consultants_id_fk');
		});
	}

}
