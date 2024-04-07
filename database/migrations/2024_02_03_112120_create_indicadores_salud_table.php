<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indicadores_salud', function (Blueprint $table) {
            $table->id();
            $table->string('enfermedad_periodontal')->nullable();
            $table->string('tipo_oclusion')->nullable();
            $table->string('nivel_fluorosis')->nullable();
            $table->timestamps();

            $table->foreignId('odontograma_id')->constrained('odontograma_cabecera');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicadores_salud');
    }
};
