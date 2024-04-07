<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('motivo_consulta');
            $table->text('enfermedad_actual');
            $table->string('presion_arterial')->nullable();
            $table->float('frecuencia_cardiaca')->nullable();
            $table->float('frecuencia_respiratoria')->nullable();
            $table->float('temperatura')->nullable();
            $table->text('partes_examen_estomatognatico')->nullable();
            $table->text('observaciones_examen')->nullable();
            

            // Definir claves foráneas
            $table->unsignedBigInteger('paciente_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
