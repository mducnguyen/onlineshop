<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableCategoriesProductsToCategoryProduct extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categories_products', function(Blueprint $table)
		{
      $table->rename('category_product');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categories_products', function(Blueprint $table)
		{
      $table->rename('categories_products');
		});
	}

}
