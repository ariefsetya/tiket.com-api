<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogtrxesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logtrxes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->longtext('request');
			$table->longtext('response');
			$table->integer('status_code');
			$table->text('token');
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
		Schema::drop('logtrxes');
	}

}
