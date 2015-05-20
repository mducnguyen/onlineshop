<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCategoriesIdToCategoryId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('category_product', function(Blueprint $table)
		{
      $table->renameColumn('categories_id', 'category_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('category_product', function(Blueprint $table)
		{
      $table->renameColumn('category_id', 'categories_id');
		});
	}

}
