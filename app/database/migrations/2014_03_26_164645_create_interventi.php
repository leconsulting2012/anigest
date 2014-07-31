<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterventi extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interventi',  function($table)
		{
			$table->increments('id');
			$table->integer('tipiIntervento_id');
			$table->integer('antenna_id');
			$table->integer('router_id');
			$table->integer('anagrafica_id');
			$table->dateTime('dataInstallazione');
			$table->integer('user_id');
			$table->boolean('confermato');
			$table->boolean('completato');
			$table->integer('priorita');
			$table->boolean('consegnaACPE');
			$table->longText('note');
			$table->integer('azienda_id')->default('0');
			$table->string('ip', 60);
			$table->string('bsid', 60);
			$table->string('rssi', 60);
			$table->string('cmri', 60);
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('antenne', function($table)
		{
			$table->dropColumn('ip');
			$table->dropColumn('bsid');
			$table->dropColumn('rssi');
			$table->dropColumn('cmri');
			$table->dateTime('dataRicezione');
			$table->dateTime('dataConsegna');
			$table->dateTime('dataMontaggio');
		});
		Schema::table('routers', function($table)
		{
			$table->dateTime('dataRicezione');
			$table->dateTime('dataConsegna');
			$table->dateTime('dataMontaggio');
		});		
		Schema::create('tipiIntervento',  function($table)
		{
			$table->increments('id');
			$table->string('tipo', 64);
			$table->integer('peso');
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
		Schema::drop('tasks');
		Schema::drop('tipiIntervento');
	}

}
