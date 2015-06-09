<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('basket_items', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('productID');
            $table->foreign('productID')->references('productID')->on('products')->onDelete('cascade');
            $table->integer('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->integer('units');
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
		Schema::drop('basket_items');
	}

}
