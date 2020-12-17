<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash')->nullable();
            $table->string('matric_number');
            $table->string('name');
            $table->unsignedBigInteger('university_id');
            $table->string('faculty_id');
            $table->string('dean_id')->nullable();
            $table->string('rector_id')->nullable();
            $table->string('department_id');
            $table->string('template_id')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('date_endorse')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('qr_code_path')->nullable();
            $table->string('pdf_doc_path')->nullable();
            $table->string('batch')->nullable();
            $table->unsignedBigInteger('academic_levels_id')->nullable();
            $table->tinyInteger('is_import')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
