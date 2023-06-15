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
        Schema::create('presupuesto_cabecera', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->float('total', 8, 2);

            //llaves foraneas
            $table->foreignId('paciente_id')->constrained('pacientes');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuesto_cabecera');
    }
};
