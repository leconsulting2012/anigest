<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntenneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('antenne', function($table)
		{
			$table->increments('id');
			$table->string('mac', 60);
			$table->string('seriale', 60);
			$table->integer('modelloAntenna_id');
			$table->string('ip', 60);
			$table->string('bsid', 60);
			$table->string('rssi', 60);
			$table->string('cmri', 60);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('modelliAntenna', function($table)
		{
			$table->increments('id');
			$table->string('nome', 60);

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
		Schema::drop('antenne');
		Schema::drop('modelliAntenna');		
	}

}
