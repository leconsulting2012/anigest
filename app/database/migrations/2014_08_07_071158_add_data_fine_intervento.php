<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataFineIntervento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('interventi', function(Blueprint $table)
		{
			$table->dateTime('dataFineIntervento')->after('dataIntervento');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('interventi', function(Blueprint $table)
		{
			//
		});
	}

}
