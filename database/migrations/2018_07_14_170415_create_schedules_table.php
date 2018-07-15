<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schedules', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('dia', 50)->nullable();
			$table->time('hr_inicio')->nullable();
			$table->time('hr_fin')->nullable();
			$table->integer('asesor')->nullable()->index('horario_asesor_index');
			$table->string('code')->nullable()->unique('schedules_code_uindex');
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
		Schema::drop('schedules');
	}

}
