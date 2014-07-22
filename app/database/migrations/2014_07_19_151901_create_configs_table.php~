<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('timerduration');	
			$table->integer('adpoptime');
			$table->integer('adduration');
			$table->integer('servicedelay');
			$table->integer('permilreload');		
		});

		DB::table('configs')->insert(
			array(
				array(
					'timerduration'=>20000,
					'adpoptime'=>4000,
					'adduration'=>4000,
					'servicedelay'=>30000,
					'permilreload'=>5,
				)
				
			)
			
		);

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('configs');
	}

}
