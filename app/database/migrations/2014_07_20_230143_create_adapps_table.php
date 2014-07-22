<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdappsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adapps', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('img_one');
			$table->string('dest_one');
		});

		DB::table('adapps')->insert(
			array(
				array(
					'img_one'=>'http://www.ga-it.cn/static/hch/image/zhe800_md_banner.png',
					'dest_one'=>'http://cdn.ga-it/apps/zhe800-2.apk'
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
		Schema::drop('adapps');
	}

}
