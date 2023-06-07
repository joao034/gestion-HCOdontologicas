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
        Schema::create('antecedentes_infecciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('enfermedad_respiratoria')->nullable();
            $table->boolean('fiebre')->nullable();
            $table->boolean('hospitalizado')->nullable();
            $table->string('razon_hospitalizacion')->nullable();
            $table->boolean('detectado_covid')->nullable();
            $table->string('parentesco_covid')->nullable();
            $table->string('grado_contagio')->nullable();
            $table->unsignedBigInteger('paciente_id')->nullable();
            

            //llave foranea
            $table->foreign('paciente_id')->references('id')->on('pacientes');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_infecciones');
    }
};
