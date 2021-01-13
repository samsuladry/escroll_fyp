<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyPreimportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pre_imports', function (Blueprint $table) {
			$table->foreign('university_id')
                  ->references('id')
                  ->on('universities');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pre_imports', function (Blueprint $table) {
            $table->dropForeign('pre_imports_university_id_foreign');
        });
    }
}
