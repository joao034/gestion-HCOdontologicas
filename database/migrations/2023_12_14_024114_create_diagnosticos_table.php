<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('diagnostico')->nullable();
            //$table->string('enfermedad_actual')->nullable();
            $table->string('CIE')->nullable();
            $table->string('tipo')->nullable();

            //foreing key
            $table->unsignedBigInteger('paciente_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosticos');
    }
};
