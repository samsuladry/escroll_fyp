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
            $table->uuid('uuid')->nullable();
            $table->string('matric_number');
            $table->string('name');
            $table->string('field');
            $table->string('university_id');
            $table->string('rector_id');
            $table->string('faculty_id');
            $table->string('dean_id');
            $table->string('department_id');
            $table->string('template_id');
            $table->string('qr_code_path')->nullable();
            $table->string('pdf_doc_path')->nullable();
            $table->string('blockchain_path')->nullable();
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
