<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscrollTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escroll_template', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('university_id');
            $table->string('description')->nullable();
            $table->string('name_position')->nullable();
            $table->string('bachelor_position')->nullable();
            $table->string('left_signature_position')->nullable();
            $table->string('right_signature_position')->nullable();
            $table->string('qr_position')->nullable();
            $table->string('serial_no_position')->nullable();
            $table->string('date_endorse_position')->nullable();
            $table->string('image_template');
            $table->tinyInteger('active')->default(1);
            $table->timestamps();

            // $table->foreign('university_id')
            //       ->references('id')
            //       ->on('universities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escroll_template');
    }
}
