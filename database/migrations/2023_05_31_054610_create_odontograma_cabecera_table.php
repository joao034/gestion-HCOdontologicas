<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('odontograma_cabecera', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('total');
            
            //foreign key
            //$table->foreignId('paciente_id')->constrained('pacientes');
            $table->foreignId('hclinica_id')->constrained('historias_clinicas');
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('odontograma_cabecera');
    }
};
