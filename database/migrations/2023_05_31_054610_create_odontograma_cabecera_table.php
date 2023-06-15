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
        Schema::create('odontograma_cabecera', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('diagnostico')->nullable();
            $table->string('enfermedad_actual')->nullable();
            $table->date('fecha_creacion');
            
            //clave foranea
            $table->foreignId('paciente_id')->constrained('pacientes');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odontograma_cabecera');
    }
};
