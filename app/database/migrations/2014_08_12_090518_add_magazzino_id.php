<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMagazzinoId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('antenne', function(Blueprint $table)
		{
			$table->integer('magazzino_id')->default(0);
		});
		Schema::table('routers', function(Blueprint $table)
		{
			$table->integer('magazzino_id')->default(0);
		});		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('antenne', function(Blueprint $table)
		{
			//
		});
	}

}
