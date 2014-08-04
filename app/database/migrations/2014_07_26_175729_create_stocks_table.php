<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		# Create the authors table
		Schema::create('stocks', function($table) {

			# AI, PK
			$table->increments('id');

			# General data...
			$table->string('stock_name');

			$table->string('stock_symb');

			$table->double('prev_day');

			$table->double('week_avg');

			$table->double('mon_avg');

			$table->double('year_avg');

			# Define foreign keys...
			# none needed

		});

		# Create the authors table
		Schema::create('userstocks', function($table) {

			# AI, PK
			$table->increments('id');

			# General data...

			$table->integer('user_id')->unsigned();

			$table->integer('stock_id')->unsigned();

			$table->double('num_units');

			$table->timestamps();

			# Define foreign keys...
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('stock_id')->references('id')->on('stocks');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('userstocks');
		Schema::drop('stocks');
	}

}
