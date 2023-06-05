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
        Schema::create('antecedentes_personales_familiares', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->string('enfermedades', 255)->nullable();
            $table->string('parentesco', 100)->nullable();
            $table->string('medicamento', 100)->nullable();
            $table->boolean('embarazada')->nullable();
            $table->integer('semanas_embarazo')->nullable();
            $table->string('otro_antecendente', 100)->nullable();
            $table->string('habitos', 255)->nullable();

            //llave foranea
            $table->foreign('paciente_id')->references('id')->on('pacientes');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_personales_familiares');
    }
};
