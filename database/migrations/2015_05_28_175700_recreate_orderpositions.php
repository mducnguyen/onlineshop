<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateOrderpositions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orderpositions', function(Blueprint $table)
		{
//			$table->increments('id');
            $table->integer('orderID')->unsigned()->index();
            $table->integer('productID')->unsigned()->index();
            $table->foreign('productID')->references('productID')->on('products')->onDelete('cascade');
            $table->foreign('orderID')->references('id')->on('orders')->onDelete('cascade');
            $table->integer('mass');
			$table->timestamps();

            $table->primary(['orderID','productID']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orderpositions');
	}

}
