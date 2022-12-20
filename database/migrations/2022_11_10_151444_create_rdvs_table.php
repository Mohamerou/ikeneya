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
        Schema::create('rdvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users');
            $table->foreignId('patient_id')->constrained('users');
            $table->string('patient_phone');
            $table->string('patient_name');
            $table->string('doctor_name');
            $table->string('patient_profil_pic');
            $table->string('rdv_request_subject');
            $table->string('rdv_request_content');
            $table->dateTime('rdv_request_date');
            $table->dateTime('rdv_time');
            $table->string('rdv_status')->default('initiated');
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
        Schema::dropIfExists('rdvs');
    }
};
