<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnagrafiche extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anagrafiche', function($table)
		{
			$table->increments('id');
			$table->string('cognome', 60);
			$table->string('nome', 60);
			$table->string('indirizzo1', 200);
			$table->string('indirizzo2', 200);
			$table->string('cap', 10);
			$table->string('citta', 50);
			$table->string('provincia', 50);
			$table->string('telefono', 50);
			$table->string('fax', 50);
			$table->string('cellulare', 50);
			$table->string('email', 50);
			$table->string('piva', 60);
			$table->string('cfiscale', 50);
			$table->integer('company_id');
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
		Schema::drop('anagrafiche');
	}

}