<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('odontograma_detalle', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha_realizado')->nullable();
            $table->string('num_pieza_dental', 100)->nullable();
            $table->string('cara_dental', 100)->nullable();
            $table->string('observacion', 255)->nullable();
            $table->string('estado', 25)->nullable();
            $table->float('precio', 8, 2);

            //foreign keys
            $table->foreignId('odontograma_cabecera_id')->constrained('odontograma_cabecera');
            $table->foreignId('tratamiento_id')->constrained('tratamientos');
            /* $table->foreignId('odontologo_id')->constrained('odontologos');
            $table->foreignId('simbolo_id')->constrained('simbolos');        */  
            $table->unsignedBigInteger('odontologo_id')->nullable();
            $table->unsignedBigInteger('simbolo_id')->nullable();   
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('odontograma_detalle');
    }
};
