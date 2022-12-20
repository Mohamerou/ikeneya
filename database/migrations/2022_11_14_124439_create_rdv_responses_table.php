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
            $table->foreignId('patient_id')->constrained('users');
            $table->foreignId('doctor_id')->constrained('users');
            $table->string('doctor_phone');
            $table->string('doctor_name');
            $table->string('patient_name');
            $table->string('doctor_profil_pic');
            $table->string('rdv_response_subject')->nullable();
            $table->string('rdv_response_content')->nullable();
            $table->dateTime('rdv_response_date')->nullable();
            $table->dateTime('rdv_request_date')->nullable();
            $table->dateTime('rdv_time')->nullable();
            $table->string('rdv_response_status')->default('reply');
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
