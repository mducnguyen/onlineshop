<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOrderPositionsTableToOrderpositions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $oldName = 'order_positions';
        $newName = 'orderpositions';
        Schema::rename('' . $oldName . '', $newName);
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

        $oldName = 'orderpositions';
        $newName = 'order_positions';
        Schema::rename('' . $oldName . '', $newName);
	}

}
