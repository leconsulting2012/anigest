<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouters extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routers',  function($table)
		{
			$table->increments('id');
			$table->string('seriale', 60);
			$table->string('mac', 60);
			$table->integer('modelliRouter_id')->default('0');
			$table->integer('azienda_id')->default('0');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('modelliRouter',  function($table)
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
		Schema::table('routers', function(Blueprint $table)
		{
			Schema::drop('installazioni');
			Schema::drop('modelliRouter');
		});
	}

}