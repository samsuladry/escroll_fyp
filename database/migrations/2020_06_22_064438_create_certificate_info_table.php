<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('name');
            $table->string('location');
            $table->string('reason');
            $table->string('contact_info');
            $table->string('certificate')->default(0);
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
        Schema::dropIfExists('certificate_info');
    }
}
