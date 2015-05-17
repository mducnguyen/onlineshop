<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->uniqe();
			$table->timestamps();
		});

		Schema::create('categories_products', function(Blueprint $table)
		{
			$table->integer('categories_id')->unsigned()->index();
			$table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');

			$table->integer('product_id')->unsigned()->index();
			$table->foreign('product_id')->references('productID')->on('products')->onDelete('cascade');
			
			$table->primary(['categories_id','product_id']);

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
		Schema::drop('categories');
		Schema::drop('categories_products');
	}

}
