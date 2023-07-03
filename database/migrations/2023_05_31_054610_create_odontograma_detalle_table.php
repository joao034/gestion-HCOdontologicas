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
        Schema::create('odontograma_detalle', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->string('num_pieza_dental', 100)->nullable();
            $table->string('cara_dental', 100)->nullable();
            $table->string('observacion', 255)->nullable();
            $table->string('estado', 25)->nullable();

            //claves foraneas
            $table->foreignId('odontograma_cabecera_id')->constrained('odontograma_cabecera');
            $table->foreignId('tratamiento_id')->constrained('tratamientos');
            $table->foreignId('odontologo_id')->constrained('odontologos');
            $table->foreignID('simbolo_id')->constrained('simbolos');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odontograma_detalle');
    }
};
