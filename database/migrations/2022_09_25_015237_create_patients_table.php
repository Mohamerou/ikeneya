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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('medical_card_id')->nullable()->constrained('medical_cards');
            $table->string('patient_code');
            $table->string('profil_pic');
            $table->string('id_card');
            $table->string('gender');
            $table->foreignId('added_by_user_id')->constrained('users');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('patients');
    }
};
