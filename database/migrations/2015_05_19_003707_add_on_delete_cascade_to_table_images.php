<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteCascadeToTableImages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('images', function(Blueprint $table)
		{
			$table->foreign('productID')->references('productsID')->on('products')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('images', function(Blueprint $table)
		{
			$table->foreign('productID')->references('productID')->on('products');
		});
	}

}
