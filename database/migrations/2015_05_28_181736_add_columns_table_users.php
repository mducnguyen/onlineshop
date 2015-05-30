<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsTableUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
            $table->string('telephone')->nullable();
            $table->string('street')->nullable();
            $table->integer('ZIPCode')->nullable();
            $table->string('City')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
            $table->dropColumn('telephone');
            $table->dropColumn('street');
            $table->dropColumn('ZIPCode');
            $table->dropColumn('City');
		});
	}

}
