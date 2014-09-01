<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMagazzino extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('magazzino', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('materiale', array('a', 'r'));
			$table->integer('materiale_id');
			$table->integer('posizione_id');
			$table->integer('destinatario_id');
			$table->timestamps();
		});

		Schema::table('antenne', function($table)
		{
			$table->dropColumn('magazzino_id');
		});

		Schema::table('routers', function($table)
		{
			$table->dropColumn('magazzino_id');
		});		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('magazzino');
	}

}
