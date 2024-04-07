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
            //$table->date('fecha_creacion');
            $table->float('total');
            
            //foreign key
            $table->foreignId('paciente_id')->constrained('pacientes');
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('odontograma_cabecera');
    }
};
