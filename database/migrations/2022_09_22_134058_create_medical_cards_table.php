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
        Schema::create('medical_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('urgency_contact1_full_name')->nullable();
            $table->string('urgency_contact1_address')->nullable();
            $table->string('urgency_contact1_phone')->nullable();
            $table->string('urgency_contact2_full_name')->nullable();
            $table->string('urgency_contact2_address')->nullable();
            $table->string('urgency_contact2_phone')->nullable();
            $table->string('treating_doctor_name')->nullable();
            $table->string('treating_doctor_address')->nullable();
            $table->string('treating_doctor_phone')->nullable();
            $table->boolean('diabetes')->nullable();
            $table->boolean('asthma')->nullable();
            $table->boolean('heart_condition')->nullable();
            $table->boolean('skin_condition')->nullable();
            $table->boolean('physical_disability')->nullable();
            $table->boolean('others')->nullable();
            $table->text('others_precision')->nullable();
            $table->string('gravity_frequency')->nullable();
            $table->boolean('alergic')->nullable();
            $table->text('alergy_precision')->nullable();
            $table->boolean('special_diet')->nullable();
            $table->text('special_diet_precision')->nullable();
            $table->text('special_medical_treatment')->nullable();
            $table->boolean('special_treatment')->nullable();
            $table->boolean('tetanus_vaccine')->nullable();
            $table->date('tetanus_vaccine_date')->nullable();
            $table->boolean('tetanus_serum')->nullable();
            $table->date('tetanus_serum_date')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('Rhesus')->nullable();
            $table->string('possible_remarks')->nullable();
            $table->string('unique_token')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('medical_card_pdf')->nullable();
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
        Schema::dropIfExists('medical_cards');
    }
};
