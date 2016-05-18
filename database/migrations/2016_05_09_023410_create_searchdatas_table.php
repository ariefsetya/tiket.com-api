<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchdatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('searchdatas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('depart_city');
			$table->text('arrive_city');
			$table->date('depart_date');
			$table->date('return_date');
			$table->integer('adult');
			$table->integer('child');
			$table->integer('infant');
			$table->text('token');
			$table->integer('ver');
			$table->longtext('result');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('searchdatas');
	}

}
