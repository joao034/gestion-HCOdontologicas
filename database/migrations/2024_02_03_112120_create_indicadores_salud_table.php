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
        Schema::create('indicadores_salud', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('odontograma_id');
            $table->foreign('odontograma_id')->references('id')->on('odontograma_cabecera');
            $table->string('enfermedad_periodontal')->nullable();
            $table->string('tipo_oclusion')->nullable();
            $table->string('nivel_fluorosis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicadores_salud');
    }
};
