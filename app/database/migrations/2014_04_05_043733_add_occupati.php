<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOccupati extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('anagrafiche', function($table)
		{
			$table->boolean('interventoOccupato')->default('0');
		});
		Schema::table('antenne', function($table)
		{
			$table->boolean('interventoOccupato')->default('0');
		});
		Schema::table('routers', function($table)
		{
			$table->boolean('interventoOccupato')->default('0');
		});		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
