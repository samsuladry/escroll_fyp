<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyAcademicLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('academic_levels', function (Blueprint $table) {
			$table->foreign('university_id')
                  ->references('id')
                  ->on('universities');
		});

		Schema::table('students', function (Blueprint $table) {
            $table->foreign('academic_levels_id')
                  ->references('id')
                  ->on('academic_levels');
        });

        Schema::table('pre_imports', function (Blueprint $table) {
            $table->foreign('academic_levels_id')
                  ->references('id')
                  ->on('academic_levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('academic_levels', function (Blueprint $table) {
            $table->dropForeign('academic_levels_university_id_foreign');
            $table->dropForeign('students_academic_levels_id_foreign');
            $table->dropForeign('pre_imports_academic_levels_id_foreign');
        });
    }
}
