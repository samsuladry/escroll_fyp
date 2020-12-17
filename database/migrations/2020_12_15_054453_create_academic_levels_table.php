<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('university_id');
            $table->string('name');
            $table->tinyInteger('is_delete');
            $table->timestamps();

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
        Schema::dropIfExists('academic_levels');
    }
}
