<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateComponenetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('components', function(Blueprint $table)
		{
            $table->integer('upperPart')->unsigned()->index();
            $table->foreign('upperPart')->references('productID')->on('products')->onDelete('cascade');

            $table->integer('subPart')->unsigned()->index();
            $table->foreign('subPart')->references('productID')->on('products')->onDelete('cascade');

            $table->timestamps();

            $table->primary(['upperPart', 'subPart']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('components');
	}

}
