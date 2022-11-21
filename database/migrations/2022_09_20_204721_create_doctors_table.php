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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users");
            $table->string('type');
            $table->string('job_title');
            $table->string('code');
            $table->string('gender')->nullable();
            $table->string('hospital');
            $table->string('id_card')->nullable();
            $table->string('doctor_card')->nullable();
            $table->string('profil_pic')->nullable();
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
        Schema::dropIfExists('doctors');
    }
};
