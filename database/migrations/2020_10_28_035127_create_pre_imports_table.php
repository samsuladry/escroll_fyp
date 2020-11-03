<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matric_no');
            $table->string('name');
            $table->string('faculty');
            $table->string('programme');
            $table->string('citizenship');
            $table->string('serial_no');
            $table->string('date_endorse');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('is_import')->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pre_imports');
    }
}
