<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdv_responses', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id');
            $table->string('doctor_id');
            $table->string('doctor_fullname');
            $table->string('doctor_phone');
            $table->string('rdv_content');
            $table->string('rdv_date');
            $table->string('doctor_urlAvatar');
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
        Schema::dropIfExists('rdv_responses');
    }
};
