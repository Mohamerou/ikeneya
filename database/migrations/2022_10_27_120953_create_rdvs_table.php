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
            $table->string('patient_id');
            $table->string('doctor_id');
            $table->string('patient_fullname');
            $table->string('patient_phone');
            $table->string('rdv_subject');
            $table->string('rdv_content');
            $table->string('rdv_date');
            $table->string('patient_urlAvatar');
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
