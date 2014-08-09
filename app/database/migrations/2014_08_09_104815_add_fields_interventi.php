<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInterventi extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('interventi', function(Blueprint $table)
		{
			$table->boolean('esito')->default(0);
			$table->longText('testoEsito')->default('');
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
