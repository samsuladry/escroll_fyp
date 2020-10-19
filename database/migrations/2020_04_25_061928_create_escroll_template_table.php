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
            $table->text('user_id');
            $table->text('description');
            $table->string('image_template');
            $table->string('pdf_template');
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
        Schema::dropIfExists('escroll_template');
    }
}
