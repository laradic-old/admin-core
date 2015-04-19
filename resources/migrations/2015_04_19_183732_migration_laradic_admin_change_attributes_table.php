<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationLaradicAdminChangeAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attributes', function(Blueprint $table)
		{
			$table->string('field_type')->default('text');
            $table->boolean('enabled')->default(1);
            $table->string('label');
            $table->string('description')->nullable();
            $table->unique('slug');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attributes', function(Blueprint $table)
		{
            $columns = ['field_type', 'enabled', 'label', 'description'];
            foreach($columns as $column)
            {
                $table->dropColumn($column);
            }
			$table->dropUnique('slug');
		});
	}

}
