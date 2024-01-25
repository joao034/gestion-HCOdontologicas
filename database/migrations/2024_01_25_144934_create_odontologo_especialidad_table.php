<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('odontologo_especialidad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('odontologo_id');
            $table->unsignedBigInteger('especialidad_id');
            $table->timestamps();

            //referencias
            $table->foreign('odontologo_id')->references('id')->on('odontologos'); 
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odontologo_especialidad');
    }
};
