<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTableComponents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('components');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::create('components', function(Blueprint $table)
        {
            $table->integer('upperPart')->unsigned()->index();
            $table->foreign('upperPart')->references('productID')->on('upperPart')->onDelete('cascade');

            $table->integer('subPart')->unsigned()->index();
            $table->foreign('subPart')->references('productID')->on('subPart')->onDelete('cascade');

            $table->timestamps();

            $table->primary(['upperPart', 'subPart']);
        });
	}

}
