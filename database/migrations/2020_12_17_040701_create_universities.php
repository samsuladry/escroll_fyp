<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('blockchainAddress')->nullable();
            $table->string('acronym');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });

        schema::table('rectors', function (Blueprint $table)
        {
            $table->unsignedBigInteger('university_id')->change();
            // $table->foreign('university_id')->references('id')->on('universities');
            $table->foreign('university_id')
                  ->references('id')
                  ->on('universities');
        });

        schema::table('escroll_template', function (Blueprint $table)
        {
            $table->unsignedBigInteger('university_id')->change();
            $table->foreign('university_id')->references('id')->on('universities');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universities');
        // Schema::dropIfExists('rectors');
        // Schema::dropIfExists('escroll_templates');
    }
}
