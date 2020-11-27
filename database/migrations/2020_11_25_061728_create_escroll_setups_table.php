<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscrollSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escroll_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('escroll_template_id');
            $table->tinyInteger('name')->default(1);
            $table->tinyInteger('bachelor')->default(1);
            $table->tinyInteger('left_signature')->default(1);
            $table->tinyInteger('right_signature')->default(1);
            $table->tinyInteger('qr')->default(1);
            $table->tinyInteger('serial_no')->default(1);
            $table->tinyInteger('date_endorse')->default(1);
            $table->string('other_variable')->nullable();
            $table->timestamps();

            $table->foreign('escroll_template_id')
                  ->references('id')
                  ->on('escroll_template');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escroll_setups');
    }
}
