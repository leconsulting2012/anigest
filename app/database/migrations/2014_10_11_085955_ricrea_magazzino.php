<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RicreaMagazzino extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('magazzino');
		Schema::create('magazzino',  function($table)
		{
			$table->increments('id');
			$table->string('tipoMateriale', 1)		->default(0);
			$table->integer('idMateriale')			->default(0);
			$table->string('tipoPosizione', 1)		->default(0);
			$table->integer('idPosizione')			->default(0);
		//	$table->string('tipoDestinazione', 1)	->nullable();
		//	$table->integer('idDestinazione')		->nullable();
			$table->string('note', 200)				->nullable();
			$table->timestamps();			
		});
		Schema::table('antenne', function($table)
		{
			$table->dropColumn('dataRicezione');
			$table->dropColumn('dataConsegna');
			$table->dropColumn('dataMontaggio');
			$table->dropColumn('interventoOccupato');
		});
		Schema::table('routers', function($table)
		{
			$table->dropColumn('dataRicezione');
			$table->dropColumn('dataConsegna');
			$table->dropColumn('dataMontaggio');
			$table->dropColumn('interventoOccupato');
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('magazzino', function(Blueprint $table)
		{
			//
		});
	}

}
